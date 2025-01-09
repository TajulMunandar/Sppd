<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use App\Models\Pegawai;
use App\Models\SuratTugas;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use App\Http\Requests\StoreSuratTugasRequest;
use App\Http\Requests\SuratTugasRequest;
use App\Http\Requests\UpdateSuratTugasRequest;
use Illuminate\Validation\ValidationException;

class SuratTugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Surat';
        $pegawais = Pegawai::all();
        $sppdId = $request->id;
        $jenis = $request->jenis;
        $tipe = Crypt::decrypt($request->jenis);

        return view('admin.sppd.surat_tugas.create', compact('title', 'pegawais', 'sppdId', 'jenis', 'tipe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSuratTugasRequest $request)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            SuratTugas::create($validatedData);
            DB::commit();
        } catch (ValidationException $exception) {
            DB::rollBack();

            return back()->with('failed', $exception->getMessage());
        }

        return redirect()->route('uang.index', ['id' => $request->sppd_id])->with('success', 'Surat tugas baru berhasil ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(SuratTugas $suratTugas)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratTugas $suratTugas)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSuratTugasRequest $request, SuratTugas $surat)
    {
        $validatedData = $request->validated();

        Arr::forget($validatedData, ['sppd_id', 'dokumen']);

        DB::beginTransaction();
        try {
            if ($request->hasFile('dokumen')) {
                $path = uploadSuratTugas($request->dokumen);
                $validatedData['dokumen'] = $path;
            }
            $validatedData['sppd_id'] = $surat->sppd_id;
            SuratTugas::where('id', $surat->id)->update($validatedData);
            DB::commit();
        } catch (ValidationException $exception) {
            DB::rollBack();

            return redirect()->back()->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }

        return redirect()->back()->with('success', "Data Surat Tugas $surat->nomor_sp2d berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratTugas $surat)
    {
        try {
            SuratTugas::destroy($surat->id);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Surat Tugas $surat->nomor_sp2d tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Surat Tugas $surat->nomor_sp2d berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Surat Tugas';
        $subtitle = 'Data Sppd Detail - Surat Tugas';
        $pegawais = Pegawai::select('id', 'nama')->get();
        if (!$sppd) {
            abort(404); // Or handle the case when the Sppd is not found
        }

        $surats = SuratTugas::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas

        return view('admin.sppd.surat_tugas.show', compact('surats', 'title', 'subtitle', 'sppd', 'pegawais'));
    }

    public function storeDetail(SuratTugasRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['tanggal_st'] = $validatedData['tanggal'];
        DB::beginTransaction();
        try {
            SuratTugas::create($validatedData);
            DB::commit();

            return redirect()->back()->with('success', 'Surat tugas baru berhasil ditambahkan!');
        } catch (ValidationException $exception) {
            DB::rollBack();

            return redirect()->back()->with('failed', $exception->getMessage());
        }
    }
}

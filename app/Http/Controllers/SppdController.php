<?php

namespace App\Http\Controllers;

use App\Exports\ExportSppdById;
use App\Exports\SppdDataExport;
use App\Http\Requests\StoreSppdRequest;
use App\Models\JenisTugas;
use App\Models\Pegawai;
use App\Models\Sppd;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class SppdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Data SPPD';
        $sppds = Sppd::with('suratTugas', 'pegawais')->latest()->get();
        $jenises = JenisTugas::all();
        $users = Pegawai::all();
        //        dd($sppds->toArray());

        return view('admin.sppd.index')->with(compact('title', 'sppds', 'jenises', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSppdRequest $request)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $sppd = Sppd::create([
                'jenis_tugas_id' => $validatedData['jenis_tugas_id'],
                'nomor_sp2d' => $validatedData['nomor_sp2d'],
                'kegiatan' => $validatedData['kegiatan'],
                'total_biaya' => $validatedData['total_biaya'],
            ]);

            $sppd->pegawais()->attach($request->pegawai);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('failed', $e->getMessage());
        }

        return to_route('surat.index', [
            'id' => Crypt::encrypt($sppd->id),
            'jenis' => Crypt::encrypt($validatedData['jenis_tugas_id']),
        ])->with('success', 'Sppd baru berhasil ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sppd $sppd)
    {
        $title = 'Detail Data Sppd';
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sppd $sppd)
    {
        $jenises = JenisTugas::all();
        $users = Pegawai::all();
        $pegawa = $sppd->pegawais->pluck('id')->toArray();
        $title = 'Edit Data Sppd';

        return view('admin.sppd.edit')->with(compact('title', 'sppd', 'jenises', 'users', 'pegawa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSppdRequest $request, Sppd $sppd)
    {
        try {
            $validatedData = $request->validated();

            // Update data SPPD
            $sppd->update($validatedData);

            // Update pegawai terkait
            $sppd->pegawais()->sync($request->pegawai);

            return redirect()->route('sppd.index')
                ->with('success', "Data SPPD $sppd->nomor_sp2d berhasil diperbarui!");
        } catch (ValidationException $exception) {
            return redirect()->route('sppd.index')->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sppd $sppd)
    {
        try {
            $sppd->delete();
            DB::statement('ALTER TABLE sppd AUTO_INCREMENT=1');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->route('sppd.index')->with('failed', "Sppd $sppd->name tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return to_route('sppd.index')->with('success', 'Data sppd berhasil dihapus!');
    }

    public function showTemplate(Sppd $sppd)
    {
    }

    public function exportExcel($sppdId)
    {
        return Excel::download(new ExportSppdById($sppdId), 'sppd-data.xlsx');
    }

    public function exportAll($jenis)
    {
        return Excel::download(new SppdDataExport($jenis), 'Data SPPD.xlsx');
    }
}

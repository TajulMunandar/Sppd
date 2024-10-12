<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sppd;
use App\Models\TotalPergi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TiketPergiRequest;
use App\Http\Requests\StoreTotalPergiRequest;
use Illuminate\Validation\ValidationException;

class TiketPergiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Tiket Pergi';
        $tiket = TotalPergi::where('sppd_id', request('id'))->first();
        $sppdId = $request->id;
        $jenis = $request->jenis;
        $tipe = Crypt::decrypt($request->jenis);

        return view('admin.sppd.total_pergi.create', compact('title', 'tiket', 'sppdId', 'jenis', 'tipe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTotalPergiRequest $request)
    {
        try {
            $validatedData = $request->validated();
            TotalPergi::updateOrCreate(
                ['sppd_id' => $request->sppd_id],
                $validatedData
            );

            return to_route('pulang.index', ['id' => $request->sppd_id])->with('success', 'Tiket Pergi baru berhasil ditambahkan!');
        } catch (Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TiketPergiRequest $request, TotalPergi $pergi)
    {
        $validatedData = $request->validated();
        $validatedData['sppd_id'] = $pergi->sppd_id;

        if ($request->hasFile('dokumen')) {
            if ($pergi->dokumen && Storage::disk('public')->exists($pergi->dokumen)) {
                Storage::disk('public')->delete($pergi->dokumen);
            }
            $validatedData['dokumen'] = uploadDokumen($request->dokumen, 'upload/tiket_pergi');
        }

        $pergi->update($validatedData);

        return redirect()->back()->with('success', "Data Tiket Pergi $pergi->asal berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalPergi $pergi)
    {
        try {
            if ($pergi->dokumen && Storage::disk('public')->exists($pergi->dokumen)) {
                Storage::disk('public')->delete($pergi->dokumen);
            }
            $pergi->delete();
            DB::statement('ALTER TABLE total_pergi AUTO_INCREMENT=1');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Tiket Pergi $pergi->asal tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Tiket Pergi $pergi->asal berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Data Sppd Detail - Tiket Pergi';
        if (!$sppd) {
            abort(404, 'Tidak ditemukan data SPPD.'); // Or handle the case when the Sppd is not found
        }

        $pergis = TotalPergi::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas

        return view('admin.sppd.total_pergi.show', compact('pergis', 'title', 'sppd'));
    }

    public function storeDetail(TiketPergiRequest $request)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('dokumen')) {
            $validatedData['dokumen'] = uploadDokumen($request->dokumen, 'upload/tiket_pergi');
        }

        TotalPergi::create($validatedData);

        return redirect()->back()->with('success', 'Tiket Pergi baru berhasil ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}

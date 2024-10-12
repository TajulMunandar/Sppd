<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAkomodasiRequest;
use App\Http\Requests\UpdateAkomodasiRequest;
use App\Models\Akomodasi;
use App\Models\Sppd;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AkomodasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Akomodasi';
        $akomodasi = Akomodasi::where('sppd_id', request('id'))->first();

        return view('admin.sppd.akomodasi.create')->with(compact('title', 'akomodasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAkomodasiRequest $request)
    {
        $validatedData = $request->validated();
        $harga = $validatedData['harga'] ?: 0;
        $lama_inap = $validatedData['lama_inap'] ?: 0;
        //            dd($validatedData);
        $validatedData['total_uang'] = $request->lama_inap != null ? $lama_inap * $harga : $validatedData['harga_diskon'];
        Akomodasi::updateOrCreate(
            ['sppd_id' => $request->sppd_id],
            $validatedData
        );

        return redirect()->route('pergi.index', ['id' => $request->sppd_id])
            ->with('success', 'Akomodasi baru berhasil ditambahkan!');
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
    public function update(UpdateAkomodasiRequest $request, Akomodasi $akomodasi)
    {
        try {

            $validatedData = $request->validated();
            $validatedData['sppd_id'] = $akomodasi->sppd_id;
            $validatedData['total_uang'] = $request->lama_inap != ''
                ? $request->lama_inap * $request->harga
                : $validatedData['harga_diskon'];

            if ($request->hasFile('dokumen')) {
                if ($akomodasi->dokumen && Storage::disk('public')->exists($akomodasi->dokumen)) {
                    Storage::disk('public')->delete($akomodasi->dokumen);
                }
                $validatedData['dokumen'] = uploadDokumen($request->dokumen, 'upload/akomodasi');
            }

            Akomodasi::where('id', $akomodasi->id)->update($validatedData);

            return redirect()->back()->with('success', "Data Akomodasi $akomodasi->name_hotel berhasil diperbarui!");
        } catch (ValidationException $exception) {
            return redirect()->back()->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Akomodasi $akomodasi)
    {
        try {
            if ($akomodasi->dokumen && Storage::disk('public')->exists($akomodasi->dokumen)) {
                Storage::disk('public')->delete($akomodasi->dokumen);
            }
            $akomodasi->delete();
            DB::statement('ALTER TABLE akomodasi AUTO_INCREMENT=1');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Akomodasi $akomodasi->name_hotel tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Akomodasi $akomodasi->name_hotel berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Akomodasi';

        if (!$sppd) {
            abort(404, 'Tidak ditemukan data SPPD.'); // Or handle the case when the Sppd is not found
        }

        $akomodasis = Akomodasi::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas

        return view('admin.sppd.akomodasi.show', compact('akomodasis', 'title', 'sppd'));
    }

    public function storeDetail(StoreAkomodasiRequest $request)
    {
        $validated = $request->validated();
        $validated['sppd_id'] = $request->sppd_id;
        $validated['total_uang'] = $request->lama_inap != ''
            ? $request->lama_inap * $request->harga
            : $validated['harga_diskon'];
        if ($request->hasFile('dokumen')) {
            $validated['dokumen'] = uploadDokumen($request->dokumen, 'upload/akomodasi');
        }
        Akomodasi::create($validated);

        return redirect()->back()->with('success', 'Akomodasi baru berhasil ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}

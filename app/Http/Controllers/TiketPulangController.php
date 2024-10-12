<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Sppd;
use App\Models\TotalPulang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\TiketPulangRequest;
use App\Http\Requests\StoreTotalPulangRequest;
use Illuminate\Validation\ValidationException;

class TiketPulangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Data Tiket Pulang';
        $tiket = TotalPulang::where('sppd_id', request('id'))->first();
        $sppdId = $request->id;
        $jenis = $request->jenis;
        $tipe = Crypt::decrypt($request->jenis);

        return view('admin.sppd.total_pulang.create', compact('title', 'tiket', 'sppdId', 'jenis', 'tipe'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTotalPulangRequest $request)
    {
        DB::beginTransaction();
        try {
            $validatedData = $request->validated();
            TotalPulang::updateOrCreate(
                ['sppd_id' => $request->sppd_id],
                $validatedData
            );
            DB::commit();

            return back()->with('success', 'Data tiket berhasil ditambahkan!');
        } catch (Exception $e) {
            DB::rollBack();

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
    public function update(TiketPulangRequest $request, TotalPulang $pulang)
    {
        try {
            $validatedData = $request->validated();
            if ($request->hasFile('dokumen')) {
                if ($pulang->dokumen && Storage::disk('public')->exists($pulang->dokumen)) {
                    Storage::disk('public')->delete($pulang->dokumen);
                }
                $validatedData['dokumen'] = uploadDokumen($request->dokumen, 'upload/tiket_pulang');
            }
            $validatedData['sppd_id'] = $pulang->sppd_id;

            $pulang->update($validatedData);

            return redirect()->back()->with('success', "Data Tiket Pulang $pulang->asal berhasil diperbarui!");
        } catch (ValidationException $exception) {
            return redirect()->back()->with('failed', 'Data gagal diperbarui! ' . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalPulang $pulang)
    {
        try {
            if ($pulang->dokumen && Storage::disk('public')->exists($pulang->dokumen)) {
                Storage::disk('public')->delete($pulang->dokumen);
            }
            $pulang->delete();
            DB::statement('ALTER TABLE total_pulang AUTO_INCREMENT=1');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                //SQLSTATE[23000]: Integrity constraint violation
                return redirect()->back()->with('failed', "Tiket Pulang $pulang->asal tidak dapat dihapus, karena sedang digunakan pada tabel lain!");
            }
        }

        return redirect()->back()->with('success', "Tiket Pulang $pulang->asal berhasil dihapus!");
    }

    public function showDetail($sppdId)
    {
        $sppd = Sppd::find($sppdId);
        $title = 'Data Sppd Detail - Tiket Pulang';
        if (!$sppd) {
            abort(404, 'Tidak ditemukan data SPPD.'); // Or handle the case when the Sppd is not found
        }

        $pulangs = TotalPulang::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas

        return view('admin.sppd.total_pulang.show', compact('pulangs', 'title', 'sppd'));
    }

    public function storeDetail(TiketPulangRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['sppd_id'] = $request->sppd_id;
            if ($request->hasFile('dokumen')) {
                $validatedData['dokumen'] = uploadDokumen($request->dokumen, 'upload/tiket_pulang');
            }
        } catch (ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
        }

        TotalPulang::create($validatedData);

        return redirect()->back()->with('success', 'Tiket Pulang baru berhasil ditambahkan!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
}

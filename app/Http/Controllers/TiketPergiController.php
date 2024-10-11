<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTotalPergiRequest;
use App\Models\Sppd;
use App\Models\TotalPergi;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
    public function update(Request $request, TotalPergi $pergi)
    {
        try {
            $rules = [
                'asal' => 'required',
                'tujuan' => 'required',
                'tgl_penerbangan' => 'required',
                'maskapai' => 'required',
                'booking_reference' => 'required',
                'no_eticket' => 'required',
                'no_penerbangan' => 'required',
                'total_harga' => 'required',
            ];

            unset($rules['sppd_id']);

            $validatedData = $this->validate($request, $rules);
            $validatedData['sppd_id'] = $pergi->sppd_id;

            TotalPergi::where('id', $pergi->id)->update($validatedData);

            return redirect()->back()->with('success', "Data Tiket Pergi $pergi->asal berhasil diperbarui!");
        } catch (ValidationException $exception) {
            return redirect()->back()->with('failed', 'Data gagal diperbarui! '.$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TotalPergi $pergi)
    {
        try {
            TotalPergi::destroy($pergi->id);
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
        if (! $sppd) {
            abort(404); // Or handle the case when the Sppd is not found
        }

        $pergis = TotalPergi::where('sppd_id', $sppdId)->get(); // Assuming there's a relationship between Sppd and SuratTugas

        return view('admin.sppd.total_pergi.show', compact('pergis', 'title', 'sppd'));
    }

    public function storeDetail(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'sppd_id' => 'required',
                'asal' => 'required',
                'tujuan' => 'required',
                'tgl_penerbangan' => 'required',
                'maskapai' => 'required',
                'booking_reference' => 'required',
                'no_eticket' => 'required',
                'no_penerbangan' => 'required',
                'total_harga' => 'required',
            ]);
        } catch (ValidationException $exception) {
            return redirect()->back()->with('failed', $exception->getMessage());
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

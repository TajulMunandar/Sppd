<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrintSuratTugasRequest;
use App\Models\Pegawai;

class CreateSuratTugasController extends Controller
{
    public function index()
    {
        $title = 'Surat Tugas';
        $pegawais = Pegawai::select('id', 'nama')->orderBy('nama')->get();

        return view('admin.surat_tugas.create.index', compact('title', 'pegawais'));
    }

    public function print(PrintSuratTugasRequest $request)
    {
        foreach ($request->pegawai as $pegawai) {
            $dataPegawai[] = Pegawai::with('golongan')->find($pegawai);
        }
        $data = $request->only('tujuan', 'bulan', 'tahun', 'nd');
        $data['pegawai'] = $dataPegawai;
        // dd($data);
        return view('admin.surat_tugas.print.index', compact('data'));
    }
}

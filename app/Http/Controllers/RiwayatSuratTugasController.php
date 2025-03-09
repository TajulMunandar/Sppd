<?php

namespace App\Http\Controllers;

use App\Models\RiwayatSuratTugas;


class RiwayatSuratTugasController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $title = 'Riwayat Surat Tugas';
        $datas = RiwayatSuratTugas::latest()->get();
        return view('admin.surat_tugas.riwayat.index', compact('title', 'datas'));
    }
}

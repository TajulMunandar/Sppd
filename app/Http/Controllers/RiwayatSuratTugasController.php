<?php

namespace App\Http\Controllers;


class RiwayatSuratTugasController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $title = 'Riwayat Surat Tugas';
        return view('admin.surat_tugas.riwayat.index', compact('title'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatSuratTugasController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $title = 'Riwayat Surat Tugas';
        return view('admin.surat_tugas.riwayat.index', compact('title'));
    }
}

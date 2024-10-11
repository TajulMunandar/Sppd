<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use Illuminate\Http\Request;

class DokumenSuratTugasController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dokumen Surat Tugas';
        $sppd = Sppd::with('pegawais')->find($request->sppd);

        return view('admin.dokumen.surat_tugas.index', compact('title', 'sppd'));

    }
}

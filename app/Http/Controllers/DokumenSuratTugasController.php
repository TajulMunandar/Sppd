<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use App\Models\SuratTugas;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class DokumenSuratTugasController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Dokumen Surat Tugas';
        $sppd = Sppd::with('pegawais')->find($request->sppd);

        return view('admin.dokumen.surat_tugas.index', compact('title', 'sppd'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokumen' => ['required', 'file', 'mimes:pdf', 'max:10240']
        ]);

        $st = SuratTugas::where('sppd_id', $request->sppd)->first();

        if (!$st) {
            return to_route('sppd.index')->with('failed', 'Surat Tugas tidak ditemukan');
        }

        if ($request->hasFile('dokumen')) {
            $filename = Str::uuid() . '.' . $request->dokumen->extension();
            $path = $request->dokumen->storeAs('upload/surat_tugas', $filename, 'public');
            $st->update(['dokumen' => $path]);
            return to_route('sppd.index')->withSuccess('Berhasil menambahkan dokumen ST.');
        }

    }
}

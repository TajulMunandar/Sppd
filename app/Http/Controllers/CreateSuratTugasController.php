<?php

namespace App\Http\Controllers;

class CreateSuratTugasController extends Controller
{
    public function index()
    {
        $title = 'Surat Tugas';

        return view('admin.surat_tugas.create.index', compact('title'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Sppd;
use Illuminate\Http\Request;

class ViewSppdController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $title = 'Data SPPD';
        $sppds = Sppd::with('pegawais.golongan', 'suratTugas', 'uangHarian', 'akomodasi', 'totalPergi', 'totalPulang')->get();

        return view('admin.sppd.view', compact('title', 'sppds'));
    }
}

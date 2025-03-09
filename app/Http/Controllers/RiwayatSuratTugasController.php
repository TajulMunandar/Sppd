<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\RiwayatSuratTugas;

class RiwayatSuratTugasController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $title = 'Riwayat Surat Tugas';
        if ($request->ajax()) {
            $datas = RiwayatSuratTugas::latest()->get();
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('pegawai', function ($row) {
                    $pegawais = json_decode($row->pegawai, true);
                    return collect($pegawais)->map(fn($p) => "{$p['nama']} ({$p['nip']})")->implode('<br>');
                })
                ->addColumn('tanggal_berangkat', function ($row) {
                    return $row->tanggal_berangkat ? $row->tanggal_berangkat->format('d/m/Y') : '-';
                })
                ->addColumn('tanggal_kembali', function ($row) {
                    return $row->tanggal_kembali ? $row->tanggal_kembali->format('d/m/Y') : '-';
                })
                ->addColumn('aksi', function ($row) {
                    return '
                    <a href="" class="btn btn-sm btn-primary"><i class="fa fa-file-pdf"></i> Lihat</a>
                    <a href="' . route('surat-tugas.riwayat.destroy', $row->id) . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>';
                })
                ->rawColumns(['pegawai', 'aksi']) // Pastikan bisa render HTML
                ->make(true);
        }
        return view('admin.surat_tugas.riwayat.index', compact('title'));
    }

    public function destroy($id)
    {
        $riwayat = RiwayatSuratTugas::findOrFail($id);
        $riwayat->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}

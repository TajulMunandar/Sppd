<?php

namespace App\Http\Controllers;

use App\Models\Kepegawaian;
use Illuminate\Http\Request;

class SyncKepegawaianController extends Controller
{
    public function sync(Request $request)
    {
        $data = $request->all();
        $apiNips = array_column($data, 'id');

        // Mendapatkan NIP yang ada di database tetapi tidak ada di data API
        $localNips = Kepegawaian::pluck('id_lama')->toArray();
        $nipsToDelete = array_diff($localNips, $apiNips);

        // Menghapus data yang tidak ada di API
        Kepegawaian::whereIn('id_lama', $nipsToDelete)->delete();
        //        dd($apiNips, $localNips, $nipsToDelete);

        foreach ($data as $pegawai) {
            Kepegawaian::updateOrCreate(
                ['id_lama' => $pegawai['id']],
                [
                    'nama' => $pegawai['nama'],
                    'gelar_depan' => $pegawai['gelar_depan'],
                    'gelar_belakang' => $pegawai['gelar_belakang'],
                    'tempat_lahir' => $pegawai['tempat_lahir'],
                    'tanggal_lahir' => $pegawai['tanggal_lahir'],
                    'nip_lama' => $pegawai['nip_lama'],
                    'nip_baru' => $pegawai['nip_baru'],
                    'universitas' => $pegawai['universitas'],
                    'jurusan' => $pegawai['jurusan'],
                    'tingkat_ijazah' => $pegawai['tingkat_ijazah'],
                    'tahun_lulus' => $pegawai['tahun_lulus'],
                    'golongan_id' => $pegawai['golongan_id'],
                    'tmt_cpns' => $pegawai['tmt_cpns'],
                    'tmt_pangkat_terakhir' => $pegawai['tmt_pangkat_terakhir'],
                    'jabatan' => $pegawai['jabatan'],
                    'masa_kerja_tahun' => $pegawai['masa_kerja_tahun'],
                    'masa_kerja_bulan' => $pegawai['masa_kerja_bulan'],
                    'unit_kerja' => $pegawai['unit_kerja'],
                    'instansi_induk' => $pegawai['instansi_induk'],
                    'alamat' => $pegawai['alamat'],
                    'telp' => $pegawai['telp'],
                    'rencana_naik_pangkat' => $pegawai['rencana_naik_pangkat'],
                    'rencana_naik_gaji' => $pegawai['rencana_naik_gaji'],
                ]
            );
        }

        return response()->json(['message' => 'Data berhasil disinkronisasi']);
    }
}

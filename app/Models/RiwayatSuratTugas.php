<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSuratTugas extends Model
{
    protected $table = 'riwayat_surat_tugas';
    protected $fillable = ['jenis', 'pegawai', 'perihal', 'tujuan', 'tanggal_berangkat', 'tanggal_kembali', 'bulan', 'tahun', 'tanggal_surat', 'pelaksana_nd', 'nip', 'nomor_nd', 'pangkat', 'jabatan', 'tanggal_nd'];

    protected $casts = [
        'tanggal_nd' => 'date',
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
    ];
}

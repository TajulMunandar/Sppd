<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'surat_tugas';

    protected $fillable = ['sppd_id', 'nomor_st', 'nomor_spd', 'kegiatan', 'dari', 'tujuan', 'lama_tugas', 'tanggal_st', 'tanggal_berangkat', 'tanggal_kembali', 'dokumen'];

    protected $casts = [
        'tanggal_st' => 'date',
        'tanggal_berangkat' => 'date',
        'tanggal_kembali' => 'date',
    ];

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}

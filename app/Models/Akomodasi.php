<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akomodasi extends Model
{
    protected $table = 'akomodasi';

    protected $fillable = ['sppd_id', 'name_hotel', 'check_in', 'check_out', 'nomor_invoice', 'nomor_kamar', 'lama_inap', 'nama_kwitansi', 'harga', 'harga_diskon', 'total_uang', 'bbm', 'dari', 'ke', 'dokumen'];

    protected $casts = [
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}

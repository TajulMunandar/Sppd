<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalPulang extends Model
{
    protected $table = 'total_pulang';

    protected $fillable = ['sppd_id', 'asal', 'maskapai', 'tujuan', 'tgl_penerbangan', 'no_penerbangan', 'booking_reference', 'no_eticket', 'total_harga', 'dokumen'];

    protected $casts = [
        'tgl_penerbangan' => 'date',
    ];

    public function Sppd()
    {
        return $this->belongsTo(Sppd::class, 'sppd_id');
    }
}

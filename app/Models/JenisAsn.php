<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisAsn extends Model
{
    use HasFactory;

    protected $table = 'jenis_asn';

    protected $fillable = ['nama'];
}

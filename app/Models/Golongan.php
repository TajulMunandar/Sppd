<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Golongan extends Model
{
    use HasFactory;

    protected $table = 'golongan';

    protected $fillable = ['kode', 'nama'];
    protected $append = ['lengkap', 'pangkat_jabatan'];

    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'golongan_id');
    }

    public function lengkap(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $this->attributes['kode'] . ' ' . $this->attributes['nama'],
        );
    }
    public function pangkatJabatan(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes['nama'] . ' (' . $this->attributes['kode'] . ')',
        );
    }
}

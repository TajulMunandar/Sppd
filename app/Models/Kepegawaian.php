<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Kepegawaian extends Model
{
    use HasFactory;

    protected $table = 'kepegawaian';

    protected $fillable = ['id_lama', 'nama', 'gelar_depan', 'gelar_belakang', 'tempat_lahir', 'tanggal_lahir', 'nip_lama', 'nip_baru', 'universitas', 'jurusan', 'tingkat_ijazah', 'tahun_lulus', 'golongan_id', 'tmt_cpns', 'tmt_pangkat_terakhir', 'jabatan', 'masa_kerja_tahun', 'masa_kerja_bulan', 'unit_kerja', 'instansi_induk', 'alamat', 'telp', 'rencana_naik_pangkat', 'rencana_naik_gaji'];

    protected $appends = [
        'nama_lengkap',
        'usia',
    ];

    public function tempatTanggalLahir(): Attribute
    {
        return Attribute::make(
            get: fn () => empty($this->attributes['tanggal_lahir'])
                ? $this->attributes['tempat_lahir']
                : $this->attributes['tempat_lahir'].', '.Carbon::parse($this->attributes['tanggal_lahir'])->translatedFormat('d F Y'),
        );
    }

    /**
     * Usia pegawai dalam tahun penuh, dihitung dari tanggal lahir.
     */
    public function usia(): Attribute
    {
        return Attribute::make(
            get: fn () => empty($this->attributes['tanggal_lahir'])
                ? null
                : Carbon::parse($this->attributes['tanggal_lahir'])->age,
        );
    }

    public function namaLengkap(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($this->attributes['gelar_depan'] != null ? $this->attributes['gelar_depan'].' ' : '').$this->attributes['nama'].($this->attributes['gelar_belakang'] != null ? ', '.$this->attributes['gelar_belakang'] : ''),
        );
    }

    public function golongan(): BelongsTo
    {
        return $this->belongsTo(Golongan::class, 'golongan_id');
    }
}

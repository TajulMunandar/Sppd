<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kepegawaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('gelar_depan');
            $table->string('gelar_belakang');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('nip_lama');
            $table->string('nip_baru');
            $table->string('universitas');
            $table->string('jurusan');
            $table->string('tingkat_ijazah');
            $table->string('tahun_lulus');
            $table->foreignId('golongan_id')->constrained('golongan');
            $table->date('tmt_cpns');
            $table->date('tmt_pangkat_terakhir');
            $table->string('jabatan');
            $table->date('tmt_jabatan');
            $table->integer('masa_kerja_tahun');
            $table->integer('masa_kerja_bulan');
            $table->string('unit_kerja');
            $table->string('instansi_induk');
            $table->string('alamat');
            $table->string('telp');
            $table->date('rencana_naik_pangkat');
            $table->date('rencana_naik_gaji');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepegawaian');
    }
};

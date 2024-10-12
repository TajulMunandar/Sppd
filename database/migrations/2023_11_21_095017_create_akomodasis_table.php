<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('akomodasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')
                ->index()
                ->constrained('sppd')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('name_hotel')->nullable();
            $table->date('check_in')->nullable();
            $table->date('check_out')->nullable();
            $table->string('nomor_invoice')->nullable();
            $table->string('nomor_kamar')->nullable();
            $table->tinyInteger('lama_inap')->nullable();
            $table->string('nama_kwitansi')->nullable();
            $table->integer('harga')->nullable();
            $table->integer('harga_diskon')->nullable();
            $table->integer('total_uang')->nullable();
            $table->integer('bbm');
            $table->string('dari');
            $table->string('ke');
            $table->string('dokumen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akomodasi');
    }
};

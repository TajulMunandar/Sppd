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
        Schema::create('total_pergi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sppd_id')
                ->index()
                ->constrained('sppd')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('asal');
            $table->string('tujuan');
            $table->date('tgl_penerbangan');
            $table->string('maskapai');
            $table->string('booking_reference');
            $table->string('no_eticket');
            $table->string('no_penerbangan');
            $table->integer('total_harga');
            $table->string('dokumen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('total_pergi');
    }
};

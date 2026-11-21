<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('kepegawaian', 'id_lama')) {
            Schema::useNativeSchemaOperationsIfPossible();

            Schema::table('kepegawaian', function (Blueprint $table) {
                $table->unsignedBigInteger('id_lama')->nullable()->after('id');
                $table->foreignId('jenis_asn_id')->nullable()->after('id_lama')
                    ->constrained('jenis_asn')->cascadeOnUpdate()->cascadeOnDelete();
            });

            Schema::table('kepegawaian', function (Blueprint $table) {
                $table->string('gelar_depan')->nullable()->change();
                $table->string('gelar_belakang')->nullable()->change();
                $table->string('nip_lama')->nullable()->change();
                $table->string('nip_baru', 100)->nullable()->change();
                $table->string('universitas')->nullable()->change();
                $table->string('tingkat_ijazah', 100)->nullable()->change();
                $table->year('tahun_lulus')->nullable()->change();
                $table->unsignedBigInteger('golongan_id')->nullable()->change();
                $table->date('tmt_cpns')->nullable()->change();
                $table->date('tmt_pangkat_terakhir')->nullable()->change();
                $table->date('tmt_jabatan')->nullable()->change();
                $table->integer('masa_kerja_tahun')->nullable()->change();
                $table->integer('masa_kerja_bulan')->nullable()->change();
                $table->date('rencana_naik_pangkat')->nullable()->change();
                $table->date('rencana_naik_gaji')->nullable()->change();
            });
        }

        // Index (bukan unique) karena produksi mungkin sudah berisi data ganda; keunikan
        // id_lama dijaga oleh proses sinkronisasi.
        if (! $this->hasIndex('kepegawaian_id_lama_index')) {
            Schema::table('kepegawaian', function (Blueprint $table) {
                $table->index('id_lama');
            });
        }
    }

    /**
     * Hanya index yang dibatalkan: kolom dan perubahan nullable sudah menjadi bagian
     * dari skema produksi, dan data yang bernilai NULL membuat pembatalannya tidak aman.
     */
    public function down(): void
    {
        if ($this->hasIndex('kepegawaian_id_lama_index')) {
            Schema::table('kepegawaian', function (Blueprint $table) {
                $table->dropIndex('kepegawaian_id_lama_index');
            });
        }
    }

    private function hasIndex(string $name): bool
    {
        return DB::table('information_schema.statistics')
            ->where('table_schema', DB::getDatabaseName())
            ->where('table_name', 'kepegawaian')
            ->where('index_name', $name)
            ->exists();
    }
};

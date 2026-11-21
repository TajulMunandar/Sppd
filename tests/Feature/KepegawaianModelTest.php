<?php

use App\Models\Kepegawaian;
use Illuminate\Support\Carbon;

function kepegawaian(array $overrides = []): Kepegawaian
{
    return Kepegawaian::create(array_merge([
        'nama' => 'Budi Santoso',
        'gelar_depan' => 'Ir.',
        'gelar_belakang' => 'M.T.',
        'tempat_lahir' => 'Meulaboh',
        'tanggal_lahir' => '1985-04-12',
        'jurusan' => 'Teknik Sipil',
        'jabatan' => 'Pengawas Lapangan',
        'unit_kerja' => 'Bidang Bina Marga',
        'instansi_induk' => 'Dinas PUPR',
        'alamat' => 'Meulaboh',
        'telp' => '081234567890',
    ], $overrides));
}

afterEach(function () {
    Carbon::setTestNow();
});

test('usia is calculated in full years from tanggal lahir', function () {
    Carbon::setTestNow('2026-04-11');
    expect(kepegawaian()->usia)->toBe(40);

    Carbon::setTestNow('2026-04-12');
    expect(kepegawaian()->usia)->toBe(41);
});

test('tempat tanggal lahir is formatted in indonesian', function () {
    expect(kepegawaian()->tempat_tanggal_lahir)->toBe('Meulaboh, 12 April 1985');
});

test('model can be serialized with its appended attributes', function () {
    Carbon::setTestNow('2026-11-21');

    expect(kepegawaian()->toArray())
        ->toHaveKey('nama_lengkap', 'Ir. Budi Santoso, M.T.')
        ->toHaveKey('usia', 41);
});

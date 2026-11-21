<?php

use App\Models\Golongan;
use App\Models\Kepegawaian;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

function pegawaiData(array $overrides = []): array
{
    return array_merge([
        'id' => 101,
        'nama' => 'Budi Santoso',
        'gelar_depan' => null,
        'gelar_belakang' => 'S.T.',
        'tempat_lahir' => 'Meulaboh',
        'tanggal_lahir' => '1985-04-12',
        'nip_lama' => null,
        'nip_baru' => '198504122010011001',
        'universitas' => 'Universitas Teuku Umar',
        'jurusan' => 'Teknik Sipil',
        'tingkat_ijazah' => 'S1',
        'tahun_lulus' => 2008,
        'golongan_id' => null,
        'tmt_cpns' => '2010-01-01',
        'tmt_pangkat_terakhir' => '2020-04-01',
        'jabatan' => 'Pengawas Lapangan',
        'masa_kerja_tahun' => 14,
        'masa_kerja_bulan' => 3,
        'unit_kerja' => 'Bidang Bina Marga',
        'instansi_induk' => 'Dinas PUPR',
        'alamat' => 'Meulaboh',
        'telp' => '081234567890',
        'rencana_naik_pangkat' => '2024-04-01',
        'rencana_naik_gaji' => '2024-01-01',
    ], $overrides);
}

function syncPegawai(array $payload)
{
    return test()->withToken('rahasia-sync')->postJson('/api/sync-kepegawaian', $payload);
}

beforeEach(function () {
    config(['services.simpeg_sync.token' => 'rahasia-sync']);
});

test('sync is rejected without a token', function () {
    $this->postJson('/api/sync-kepegawaian', [pegawaiData()])->assertUnauthorized();

    expect(Kepegawaian::count())->toBe(0);
});

test('sync is rejected with an invalid token', function () {
    $this->withToken('token-salah')
        ->postJson('/api/sync-kepegawaian', [pegawaiData()])
        ->assertUnauthorized();

    expect(Kepegawaian::count())->toBe(0);
});

test('sync is unavailable when no token is configured', function () {
    config(['services.simpeg_sync.token' => null]);

    $this->withToken('apa-saja')
        ->postJson('/api/sync-kepegawaian', [pegawaiData()])
        ->assertStatus(503);
});

test('empty payload is rejected', function () {
    syncPegawai([])->assertStatus(422);
});

test('new pegawai are created with their simpeg id', function () {
    syncPegawai([pegawaiData()])
        ->assertOk()
        ->assertJson(['message' => 'Data berhasil disinkronisasi', 'created' => 1, 'updated' => 0]);

    expect(Kepegawaian::where('id_lama', 101)->value('nama'))->toBe('Budi Santoso');
});

test('repeated sync updates instead of duplicating', function () {
    syncPegawai([pegawaiData()]);
    syncPegawai([pegawaiData(['jabatan' => 'Kepala Seksi'])])
        ->assertJson(['created' => 0, 'updated' => 1]);

    expect(Kepegawaian::count())->toBe(1)
        ->and(Kepegawaian::first()->jabatan)->toBe('Kepala Seksi');
});

test('existing pegawai without simpeg id are matched by nip', function () {
    $existing = Kepegawaian::create(Arr::except(pegawaiData(['nama' => 'Budi (manual)']), ['id']));

    syncPegawai([pegawaiData()])->assertJson(['created' => 0, 'updated' => 1]);

    expect(Kepegawaian::count())->toBe(1)
        ->and($existing->fresh()->id_lama)->toBe(101)
        ->and($existing->fresh()->nama)->toBe('Budi Santoso');
});

test('pegawai missing from the payload are kept with their sppd history', function () {
    syncPegawai([pegawaiData(), pegawaiData(['id' => 202, 'nip_baru' => '199001012015011002', 'nama' => 'Siti'])]);
    $siti = Kepegawaian::where('id_lama', 202)->first();

    $jenisTugasId = DB::table('jenis_tugas')->insertGetId(['name' => 'Dalam Daerah', 'created_at' => now(), 'updated_at' => now()]);
    $sppdId = DB::table('sppd')->insertGetId([
        'jenis_tugas_id' => $jenisTugasId, 'nomor_sp2d' => '001', 'kegiatan' => 'Pengawasan',
        'total_biaya' => 0, 'created_at' => now(), 'updated_at' => now(),
    ]);
    DB::table('sppd_pegawai')->insert(['sppd_id' => $sppdId, 'pegawai_id' => $siti->id]);

    syncPegawai([pegawaiData()])->assertOk();

    expect(Kepegawaian::whereKey($siti->id)->exists())->toBeTrue()
        ->and(DB::table('sppd_pegawai')->where('pegawai_id', $siti->id)->exists())->toBeTrue();
});

test('invalid items are skipped without failing the rest', function () {
    syncPegawai([
        pegawaiData(['id' => 301, 'tanggal_lahir' => null]),
        pegawaiData(['id' => 302, 'nip_baru' => '199202022016011003', 'alamat' => null, 'telp' => null]),
    ])
        ->assertOk()
        ->assertJson(['created' => 1, 'updated' => 0])
        ->assertJsonPath('skipped.0.id', 301);

    expect(Kepegawaian::where('id_lama', 302)->value('alamat'))->toBe('');
});

test('unknown golongan is cleared to keep the foreign key valid', function () {
    $golongan = Golongan::create(['nama' => 'Penata', 'kode' => 'III/c']);

    syncPegawai([
        pegawaiData(['id' => 401, 'nip_baru' => '1', 'golongan_id' => $golongan->id]),
        pegawaiData(['id' => 402, 'nip_baru' => '2', 'golongan_id' => 9999]),
    ])->assertJson(['created' => 2]);

    expect(Kepegawaian::where('id_lama', 401)->value('golongan_id'))->toBe($golongan->id)
        ->and(Kepegawaian::where('id_lama', 402)->value('golongan_id'))->toBeNull();
});

<?php

use App\Models\JenisTugas;
use App\Models\RiwayatSuratTugas;
use App\Models\Sppd;
use App\Models\User;
use Illuminate\Support\Carbon;
use Spatie\Permission\Models\Role;

beforeEach(function () {
    Role::create(['name' => 'admin', 'guard_name' => 'web']);
    Role::create(['name' => 'user', 'guard_name' => 'web']);
    Carbon::setTestNow('2026-11-21 09:00:00');
});

afterEach(function () {
    Carbon::setTestNow();
});

function dashboardUser(string $role): User
{
    return tap(User::factory()->create(['name' => 'Mukhlizar']), fn (User $user) => $user->assignRole($role));
}

function seedDashboard(): void
{
    $jenis = JenisTugas::create(['name' => 'Dalam Daerah']);
    foreach ([['2026-03-10', 1500000], ['2026-11-02', 2500000], ['2025-06-01', 9000000]] as [$date, $biaya]) {
        $sppd = new Sppd(['jenis_tugas_id' => $jenis->id, 'nomor_sp2d' => "SP2D-$date", 'kegiatan' => "Kegiatan $date", 'total_biaya' => $biaya]);
        $sppd->created_at = $date;
        $sppd->save();
    }

    RiwayatSuratTugas::create([
        'jenis' => 1, 'pegawai' => json_encode([['nama' => 'A'], ['nama' => 'B']]), 'perihal' => 'Pengawasan irigasi',
        'tujuan' => 'Kec. Arongan', 'tanggal_berangkat' => '2026-11-20', 'tanggal_kembali' => '2026-11-22',
        'bulan' => 11, 'tahun' => 2026, 'tanggal_surat' => '2026-11-15',
    ]);
}

test('admin dashboard shows yearly stats and active trips', function () {
    seedDashboard();

    $this->actingAs(dashboardUser('admin'))->get('/dashboard')
        ->assertOk()
        ->assertSee('Selamat pagi, Mukhlizar')
        ->assertViewHas('stats', fn (array $stats) => $stats['sppd_count'] === 2
            && $stats['sppd_last_year'] === 1
            && $stats['total_biaya'] === 4000000
            && $stats['active_trip_count'] === 1)
        ->assertSee('Rp 4,0 jt')
        ->assertSee('Pengawasan irigasi')
        ->assertSee('Sedang bertugas')
        ->assertSee('Buat surat tugas');
});

test('monthly chart data covers all twelve months of the current year', function () {
    seedDashboard();

    $this->actingAs(dashboardUser('admin'))->get('/dashboard')
        ->assertViewHas('monthly', fn ($monthly) => $monthly->count() === 12
            && $monthly[2]['value'] === 1
            && $monthly[10]['value'] === 1
            && $monthly[11]['is_future'] === true);
});

test('karyawan dashboard hides admin only sections', function () {
    seedDashboard();

    $this->actingAs(dashboardUser('user'))->get('/dashboard')
        ->assertOk()
        ->assertDontSee('Pegawai terdaftar')
        ->assertDontSee('Dinas berjalan')
        ->assertDontSee('Buat surat tugas')
        ->assertSee('SPPD terbaru');
});

test('empty dashboard shows empty states', function () {
    $this->actingAs(dashboardUser('admin'))->get('/dashboard')
        ->assertOk()
        ->assertSee('Belum ada SPPD yang dibuat tahun 2026.')
        ->assertSee('Tidak ada dinas yang sedang berjalan atau dijadwalkan.');
});

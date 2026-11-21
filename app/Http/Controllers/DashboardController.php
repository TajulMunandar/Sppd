<?php

namespace App\Http\Controllers;

use App\Models\JenisTugas;
use App\Models\Kepegawaian;
use App\Models\RiwayatSuratTugas;
use App\Models\Sppd;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    private const JENIS_SURAT_TUGAS = [1 => 'Dalam Kota', 2 => 'Luar Kota'];

    public function __invoke(Request $request)
    {
        $title = __('Dashboard');
        $today = Carbon::today();
        $year = $today->year;
        $isAdmin = $request->user()->hasRole('admin');

        $sppdThisYear = Sppd::whereYear('created_at', $year);

        $stats = [
            'sppd_count' => (clone $sppdThisYear)->count(),
            'sppd_last_year' => Sppd::whereYear('created_at', $year - 1)->count(),
            'total_biaya' => (int) (clone $sppdThisYear)->sum('total_biaya'),
        ];

        // SPPD tidak punya kolom tanggal kegiatan, sehingga tren memakai tanggal pembuatan.
        $perMonth = (clone $sppdThisYear)
            ->selectRaw('MONTH(created_at) as bulan, COUNT(*) as jumlah')
            ->groupBy('bulan')
            ->pluck('jumlah', 'bulan');

        $monthly = collect(range(1, 12))->map(fn (int $month) => [
            'label' => Carbon::create($year, $month)->translatedFormat('M'),
            'full_label' => Carbon::create($year, $month)->translatedFormat('F'),
            'value' => (int) ($perMonth[$month] ?? 0),
            'is_future' => $month > $today->month,
        ]);

        $inYear = fn ($query) => $query->whereYear('created_at', $year);
        $byJenis = JenisTugas::withCount(['Sppd as sppds_count' => $inYear])
            ->withSum(['Sppd as sppds_biaya' => $inYear], 'total_biaya')
            ->orderByDesc('sppds_count')
            ->get()
            ->map(fn (JenisTugas $jenis) => [
                'label' => $jenis->name,
                'value' => $jenis->sppds_count,
                'biaya' => (int) $jenis->sppds_biaya,
            ]);

        $latestSppd = Sppd::with(['jenisTugas', 'suratTugas'])
            ->withCount('pegawais')
            ->latest()
            ->limit(5)
            ->get();

        $activeTrips = collect();
        if ($isAdmin) {
            $stats['pegawai_count'] = Kepegawaian::count();

            $activeTrips = RiwayatSuratTugas::whereDate('tanggal_kembali', '>=', $today)
                ->orderBy('tanggal_berangkat')
                ->limit(5)
                ->get()
                ->map(fn (RiwayatSuratTugas $trip) => [
                    'perihal' => $trip->perihal,
                    'tujuan' => $trip->tujuan,
                    'jenis' => self::JENIS_SURAT_TUGAS[$trip->jenis] ?? '-',
                    'berangkat' => $trip->tanggal_berangkat,
                    'kembali' => $trip->tanggal_kembali,
                    'pegawai_count' => count(json_decode($trip->pegawai, true) ?: []),
                    'is_ongoing' => $trip->tanggal_berangkat->lte($today),
                ]);

            $stats['active_trip_count'] = RiwayatSuratTugas::whereDate('tanggal_berangkat', '<=', $today)
                ->whereDate('tanggal_kembali', '>=', $today)
                ->count();
        }

        return view('dashboard', compact(
            'title', 'today', 'year', 'isAdmin', 'stats', 'monthly', 'byJenis', 'latestSppd', 'activeTrips'
        ));
    }
}

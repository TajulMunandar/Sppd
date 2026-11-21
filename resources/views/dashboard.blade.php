@php
    $rupiah = fn (int $value) => 'Rp ' . number_format($value, 0, ',', '.');
    // Angka besar diringkas (jt/M) agar tile tetap terbaca; nilai lengkap ada di atribut title.
    $rupiahRingkas = function (int $value) use ($rupiah) {
        if ($value >= 1_000_000_000) {
            return 'Rp ' . number_format($value / 1_000_000_000, 1, ',', '.') . ' M';
        }
        if ($value >= 1_000_000) {
            return 'Rp ' . number_format($value / 1_000_000, 1, ',', '.') . ' jt';
        }

        return $rupiah($value);
    };
    $average = $stats['sppd_count'] > 0 ? intdiv($stats['total_biaya'], $stats['sppd_count']) : 0;
    $jenisTotal = max(1, $byJenis->sum('value'));
    $hour = now()->hour;
    $greeting = $hour < 11 ? 'Selamat pagi' : ($hour < 15 ? 'Selamat siang' : ($hour < 18 ? 'Selamat sore' : 'Selamat malam'));
    $chartHasData = $monthly->sum('value') > 0;
    $jenisHasData = $byJenis->sum('value') > 0;
@endphp

<x-app-layout :$title :subtitle="$greeting . ', ' . auth()->user()->name">
    <div class="dash">
        <div class="dash-intro">
            <p class="dash-intro__text">
                {{ $today->translatedFormat('l, d F Y') }} · Ringkasan perjalanan dinas tahun {{ $year }}
            </p>
            <div class="dash-intro__actions">
                @role('admin')
                    <a href="{{ route('surat-tugas.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-file-earmark-plus" aria-hidden="true"></i> Buat surat tugas
                    </a>
                @endrole
                <a href="{{ route('sppd.index') }}#tambahSppd" class="btn btn-primary">
                    <i class="bi bi-plus-lg" aria-hidden="true"></i> Buat SPPD
                </a>
            </div>
        </div>

        <section class="dash-kpis" aria-label="Ringkasan angka">
            <article class="dash-kpi">
                <span class="dash-kpi__icon"><i class="bi bi-journal-text" aria-hidden="true"></i></span>
                <p class="dash-kpi__label">SPPD tahun ini</p>
                <p class="dash-kpi__value">{{ number_format($stats['sppd_count'], 0, ',', '.') }}</p>
                <p class="dash-kpi__meta">Tahun lalu: {{ number_format($stats['sppd_last_year'], 0, ',', '.') }}</p>
            </article>

            <article class="dash-kpi">
                <span class="dash-kpi__icon"><i class="bi bi-cash-stack" aria-hidden="true"></i></span>
                <p class="dash-kpi__label">Total biaya tahun ini</p>
                <p class="dash-kpi__value" title="{{ $rupiah($stats['total_biaya']) }}">
                    {{ $rupiahRingkas($stats['total_biaya']) }}
                </p>
                <p class="dash-kpi__meta">Rata-rata {{ $rupiahRingkas($average) }} per SPPD</p>
            </article>

            @role('admin')
                <article class="dash-kpi">
                    <span class="dash-kpi__icon"><i class="bi bi-geo-alt" aria-hidden="true"></i></span>
                    <p class="dash-kpi__label">Sedang bertugas</p>
                    <p class="dash-kpi__value">{{ number_format($stats['active_trip_count'], 0, ',', '.') }}</p>
                    <p class="dash-kpi__meta">Surat tugas berjalan hari ini</p>
                </article>

                <article class="dash-kpi">
                    <span class="dash-kpi__icon"><i class="bi bi-people" aria-hidden="true"></i></span>
                    <p class="dash-kpi__label">Pegawai terdaftar</p>
                    <p class="dash-kpi__value">{{ number_format($stats['pegawai_count'], 0, ',', '.') }}</p>
                    <p class="dash-kpi__meta">
                        <a href="{{ route('pegawai.index') }}" class="dash-link">Kelola pegawai</a>
                    </p>
                </article>
            @endrole
        </section>

        <div class="dash-grid">
            <section class="dash-card dash-card--chart" aria-labelledby="chart-title">
                <header class="dash-card__header">
                    <div>
                        <h2 class="dash-card__title" id="chart-title">SPPD per bulan</h2>
                        <p class="dash-card__subtitle">Berdasarkan tanggal pembuatan, tahun {{ $year }}</p>
                    </div>
                </header>

                @if ($chartHasData)
                    {{-- Data yang sama tersedia di tabel di bawah untuk pembaca layar. --}}
                    <div id="chart-monthly" class="dash-chart" role="img"
                         aria-label="Grafik batang jumlah SPPD per bulan tahun {{ $year }}"></div>
                    <details class="dash-table-toggle">
                        <summary>Lihat data dalam tabel</summary>
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr><th scope="col">Bulan</th><th scope="col" class="text-end">Jumlah SPPD</th></tr>
                            </thead>
                            <tbody>
                                @foreach ($monthly as $month)
                                    <tr><td>{{ $month['full_label'] }}</td><td class="text-end">{{ $month['value'] }}</td></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </details>
                @else
                    <div class="dash-empty">
                        <i class="bi bi-bar-chart" aria-hidden="true"></i>
                        <p>Belum ada SPPD yang dibuat tahun {{ $year }}.</p>
                    </div>
                @endif
            </section>

            <section class="dash-card" aria-labelledby="jenis-title">
                <header class="dash-card__header">
                    <div>
                        <h2 class="dash-card__title" id="jenis-title">Berdasarkan jenis tugas</h2>
                        <p class="dash-card__subtitle">Jumlah SPPD tahun {{ $year }}</p>
                    </div>
                </header>

                @if ($jenisHasData)
                    <div id="chart-jenis" class="dash-chart dash-chart--bar" role="img"
                         aria-label="Grafik batang jumlah SPPD per jenis tugas tahun {{ $year }}"></div>
                    <details class="dash-table-toggle">
                        <summary>Lihat data dalam tabel</summary>
                        <table class="table table-sm mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Jenis tugas</th>
                                    <th scope="col" class="text-end">SPPD</th>
                                    <th scope="col" class="text-end">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($byJenis as $jenis)
                                    <tr>
                                        <td>{{ $jenis['label'] }}</td>
                                        <td class="text-end">{{ $jenis['value'] }} ({{ round($jenis['value'] / $jenisTotal * 100) }}%)</td>
                                        <td class="text-end">{{ $rupiah($jenis['biaya']) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </details>
                @else
                    <div class="dash-empty">
                        <i class="bi bi-pie-chart" aria-hidden="true"></i>
                        <p>Belum ada data jenis tugas untuk tahun ini.</p>
                    </div>
                @endif
            </section>
        </div>

        <div @class(['dash-grid', 'dash-grid--single' => ! $isAdmin])>
            @if ($isAdmin)
                <section class="dash-card" aria-labelledby="trip-title">
                    <header class="dash-card__header">
                        <div>
                            <h2 class="dash-card__title" id="trip-title">Dinas berjalan &amp; mendatang</h2>
                            <p class="dash-card__subtitle">Dari riwayat surat tugas</p>
                        </div>
                        <a href="{{ route('surat-tugas.riwayat.index') }}" class="dash-link">Lihat riwayat</a>
                    </header>

                    @forelse ($activeTrips as $trip)
                        <div class="dash-trip">
                            <div class="dash-trip__date" aria-hidden="true">
                                <span>{{ $trip['berangkat']->translatedFormat('d') }}</span>
                                {{ $trip['berangkat']->translatedFormat('M') }}
                            </div>
                            <div class="dash-trip__body">
                                <p class="dash-trip__title">{{ $trip['perihal'] }}</p>
                                <p class="dash-trip__meta">
                                    <i class="bi bi-geo-alt" aria-hidden="true"></i>{{ $trip['tujuan'] }}
                                    <span aria-hidden="true">·</span>
                                    {{ $trip['berangkat']->translatedFormat('d M') }} – {{ $trip['kembali']->translatedFormat('d M Y') }}
                                    <span aria-hidden="true">·</span>
                                    {{ $trip['pegawai_count'] }} pegawai
                                </p>
                            </div>
                            @if ($trip['is_ongoing'])
                                <span class="dash-status dash-status--ongoing">
                                    <i class="bi bi-circle-fill" aria-hidden="true"></i>Sedang bertugas
                                </span>
                            @else
                                <span class="dash-status dash-status--upcoming">
                                    <i class="bi bi-clock" aria-hidden="true"></i>Akan berangkat
                                </span>
                            @endif
                        </div>
                    @empty
                        <div class="dash-empty">
                            <i class="bi bi-calendar-check" aria-hidden="true"></i>
                            <p>Tidak ada dinas yang sedang berjalan atau dijadwalkan.</p>
                            <a href="{{ route('surat-tugas.index') }}" class="dash-link">Buat surat tugas</a>
                        </div>
                    @endforelse
                </section>
            @endif

            <section class="dash-card" aria-labelledby="latest-title">
                <header class="dash-card__header">
                    <div>
                        <h2 class="dash-card__title" id="latest-title">SPPD terbaru</h2>
                        <p class="dash-card__subtitle">5 data terakhir yang dibuat</p>
                    </div>
                    <a href="{{ route('sppd.index') }}" class="dash-link">Lihat semua</a>
                </header>

                @forelse ($latestSppd as $sppd)
                    <div class="dash-sppd">
                        <div class="dash-sppd__body">
                            <p class="dash-sppd__title">{{ $sppd->kegiatan }}</p>
                            <p class="dash-sppd__meta">
                                SP2D {{ $sppd->nomor_sp2d }}
                                <span aria-hidden="true">·</span>
                                {{ $sppd->jenisTugas->name ?? '-' }}
                                <span aria-hidden="true">·</span>
                                {{ $sppd->pegawais_count }} pegawai
                                @unless ($sppd->suratTugas)
                                    <span class="dash-sppd__flag">
                                        <i class="bi bi-exclamation-circle" aria-hidden="true"></i>Belum ada surat tugas
                                    </span>
                                @endunless
                            </p>
                        </div>
                        <div class="dash-sppd__amount">
                            <span>{{ $rupiah((int) $sppd->total_biaya) }}</span>
                            <small>{{ $sppd->created_at->translatedFormat('d M Y') }}</small>
                        </div>
                    </div>
                @empty
                    <div class="dash-empty">
                        <i class="bi bi-journal-plus" aria-hidden="true"></i>
                        <p>Belum ada SPPD.</p>
                        <a href="{{ route('sppd.index') }}#tambahSppd" class="dash-link">Buat SPPD pertama</a>
                    </div>
                @endforelse
            </section>
        </div>
    </div>

    @push('script')
        <script>
            (function () {
                if (typeof ApexCharts === 'undefined') return;

                const color = { bar: '#2f55c8', future: '#dfe3e8', grid: '#eef0f2', muted: '#8592a3', text: '#22303e' };
                const rupiah = (value) => 'Rp ' + Number(value).toLocaleString('id-ID');
                const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                // Opsi bersama agar semua grafik admin tampil seragam.
                const base = {
                    chart: { type: 'bar', toolbar: { show: false }, zoom: { enabled: false }, fontFamily: 'inherit',
                             animations: { enabled: ! reduceMotion, speed: 400 }, parentHeightOffset: 0 },
                    dataLabels: { enabled: false },
                    legend: { show: false },
                    fill: { opacity: 1 },
                    grid: { borderColor: color.grid, strokeDashArray: 0, padding: { left: 4, right: 8 } },
                    states: { hover: { filter: { type: 'darken', value: 0.85 } }, active: { filter: { type: 'none' } } },
                    tooltip: { theme: 'light', marker: { show: false } },
                };
                const axisLabel = { style: { colors: color.muted, fontSize: '12px' } };

                const monthly = @json($chartHasData ? $monthly->values() : []);
                if (monthly.length) {
                    new ApexCharts(document.getElementById('chart-monthly'), {
                        ...base,
                        chart: { ...base.chart, height: 280 },
                        series: [{ name: 'SPPD', data: monthly.map((m) => m.value) }],
                        // Bulan yang belum berjalan diberi warna netral agar tidak terbaca sebagai nol yang nyata.
                        colors: [({ dataPointIndex }) => (monthly[dataPointIndex].is_future ? color.future : color.bar)],
                        plotOptions: { bar: { columnWidth: '42%', borderRadius: 4 } },
                        xaxis: { categories: monthly.map((m) => m.label), labels: axisLabel,
                                 axisBorder: { color: '#dfe3e8' }, axisTicks: { show: false },
                                 tooltip: { enabled: false } },
                        yaxis: { min: 0, forceNiceScale: true, decimalsInFloat: 0, labels: axisLabel },
                        tooltip: { ...base.tooltip,
                                   x: { formatter: (_, { dataPointIndex }) => monthly[dataPointIndex].full_label },
                                   y: { formatter: (value) => value + ' SPPD', title: { formatter: () => '' } } },
                    }).render();
                }

                const jenis = @json($jenisHasData ? $byJenis->values() : []);
                if (jenis.length) {
                    new ApexCharts(document.getElementById('chart-jenis'), {
                        ...base,
                        chart: { ...base.chart, height: 64 + jenis.length * 52 },
                        series: [{ name: 'SPPD', data: jenis.map((j) => j.value) }],
                        colors: [color.bar],
                        plotOptions: { bar: { horizontal: true, barHeight: '40%', borderRadius: 4,
                                              dataLabels: { position: 'top' } } },
                        // Nilai ditulis di ujung batang dengan warna teks, bukan warna data.
                        dataLabels: { enabled: true, offsetX: 26,
                                      style: { colors: [color.text], fontSize: '12px', fontWeight: 600 } },
                        xaxis: { categories: jenis.map((j) => j.label), labels: { show: false },
                                 axisBorder: { show: false }, axisTicks: { show: false } },
                        yaxis: { labels: { style: { colors: color.text, fontSize: '13px' }, maxWidth: 140 } },
                        grid: { ...base.grid, xaxis: { lines: { show: false } }, yaxis: { lines: { show: false } },
                                padding: { left: 0, right: 36 } },
                        tooltip: { ...base.tooltip,
                                   y: { formatter: (value, { dataPointIndex }) =>
                                            value + ' SPPD · ' + rupiah(jenis[dataPointIndex].biaya),
                                        title: { formatter: () => '' } } },
                    }).render();
                }
            })();
        </script>
    @endpush
</x-app-layout>

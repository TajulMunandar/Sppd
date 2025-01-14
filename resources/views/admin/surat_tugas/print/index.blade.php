@php
    use Carbon\Carbon;
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Tugas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Pro:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style>
        @media screen {
            body {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                align-content: center;
                background-color: #ccc
            }

            main {
                padding: 5em;
                width: 210mm;
                height: 297mm;
                background-color: white;
            }

            tbody.noborder td:not(:last-child) {
                border-bottom: none;
            }

            .spacing {
                margin-left: 2rem;
            }

            .table-bordered thead tr.tfooter th {
                padding: 0;
            }

            .tfooter.background {
                background-color: #eaeaea;
            }

            .cell-content {
                min-height: 150px;
            }
        }

        @media print {
            @page {
                size: 'A4';
            }

            main {
                padding: 1em;
                width: 210mm;
                height: 297mm;
                background-color: white;
            }

            .mt-2 {
                margin-top: 1.25rem;
            }

            .spacing {
                margin-left: 2rem;
            }

            .tfooter.background {
                background-color: #eaeaea;
            }

            .cell-content {
                min-height: 150px;
            }
        }
    </style>
</head>

<body>
    <main>
        <table>
            <tr class="header">
                <td>
                    <img src="{{ asset('images/logo/abar.png') }}" alt="logo" width="70px">
                </td>
                <td>
                    <h5>PEMERINTAH KABUPATEN ACEH BARAT</h5>
                    <h5>DINAS PEKERJAAN UMUM DAN PENATAAN RUANG</h5>
                    <p>Jalan Sisingamangaraja Lr. BKKBN - Meulaboh (23617)</p>
                    <p>email : dpupr.acehbarat@gmail.com, www.pupr.acehbarat.go.id, Ig pupracehbarat</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="garis"></div>
                </td>
            </tr>
            <tr class="content">
                <td colspan="2">
                    <div class="title">
                        <h5 class="uppercase text-underline">Surat Tugas</h5>
                        <p>NOMOR : 090/<span
                                class="nomor__agenda"></span>/ST/{{ romawi($data['bulan']) }}/{{ $data['tahun'] }}
                        </p>
                    </div>
                    <div class="isi">
                        <ol class="text-left">
                            <li>Kepala Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Aceh Barat, dengan ini
                                menugaskan
                                Pegawai Negeri Sipil (PNS) yang namanya tersebut dibawah ini :</li>
                            <li class="no-marker">
                                <table class="table table-bordered">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama/NIP</th>
                                            <th>Pangkat/Jabatan</th>
                                        </tr>
                                        <tr class="tfooter background">
                                            <th>1</th>
                                            <th>2</th>
                                            <th>3</th>
                                        </tr>
                                    </thead>
                                    <tbody class="noborder">
                                        @foreach ($pegawais as $pegawai)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <p class="nama__pegawai">{{ $pegawai['nama_lengkap'] }}</p>
                                                    <p>NIP. {{ $pegawai['nip_baru'] }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="mb-1">
                                                        {{ $pegawai['pangkats'] ? $pegawai['pangkats'][0]['golongan']['nama'] . ' (' . $pegawai['pangkats'][0]['golongan']['kode'] . ')' : '-' }}
                                                    </p>
                                                    <p class="mb-0">
                                                        {{ $pegawai['latest_jabatan'] ? $pegawai['latest_jabatan']['nama_jabatan'] : '-' }}
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </li>
                            <li class="no-marker">
                                <table>
                                    <tr>
                                        <td style="width: 10%">Untuk</td>
                                        <td style="width: 2%">:</td>
                                        <td>{{ $data['perihal'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%">Di</td>
                                        <td style="width: 2%">:</td>
                                        <td>{{ $data['tujuan'] }}</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%"></td>
                                        <td style="width: 2%"></td>
                                        <td>
                                            Pada tanggal
                                            {{ $data['tgl_pulang'] ? Carbon::parse($data['tgl_berangkat'])->translatedFormat('d F') . ' - ' . Carbon::parse($data['tgl_pulang'])->translatedFormat('d F Y') : Carbon::parse($data['tgl_berangkat'])->translatedFormat('d F Y') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 10%">Lamanya</td>
                                        <td style="width: 2%">:</td>
                                        <td>
                                            {{ $data['lama_kegiatan'] }} ({{ hitung($data['lama_kegiatan']) }})
                                            hari kerja
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Biaya</td>
                                        <td>:</td>
                                        <td>
                                            Segala biaya akibat dikeluarkannya surat tugas ini, dibebankan pada DPA/DPPA
                                            Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Aceh Barat Tahun Anggaran
                                            {{ $data['tahun'] }}
                                        </td>
                                    </tr>
                                </table>
                            </li>
                            <li>Sepulangnya dari Perjalanan Dinas diharapkan membuat Laporan Perjalanan Dinas kepada
                                Kepala Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Aceh Barat.
                            </li>
                            <li>Demikian untuk dilaksanakan sebagaimana mestinya.</li>
                        </ol>
                        <div class="signature">
                            <table>
                                <tr>
                                    <td>
                                        <div class="identitas">
                                            <p class="mb-1">Meulaboh, <span class="spacing"></span>
                                                {{ Carbon::parse($data['tgl_surat'])->translatedFormat('F Y') }}</p>
                                            <p class="mb-1 uppercase">Kepala Dinas Pekerjaan Umum dan <br>
                                                Penataan Ruang Kabupaten Aceh Barat</p>
                                            <p class="nama text-underline">
                                                {{ $data['nd'] ? $data['pelaksana'] : 'Dr. Ir. KURDI, ST., MT' }}
                                            </p>
                                            <p class="mt-1">{{ $data['nd'] ? $data['golongan'] : 'Pembina TK.I' }}
                                            </p>
                                            <p>NIP. {{ $data['nd'] ? $data['nip'] : '19760612 200504 1 00 1' }}</p>
                                            @if ($data['nd'])
                                                <p class="fw-bold">Nota Dinas : {{ $data['nomor_nd'] }}</p>
                                                <p class="fw-bold">Tanggal : {{ $data['tanggal_nd'] }}</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </main>
    <div class="mt-5 pagebreak"></div>
    <main class="mt-2">
        <table class="styled-table">
            @foreach (array_chunk(range(1, 10), 2) as $pair)
                <tr>
                    @foreach ($pair as $item)
                        <td>
                            <div class="cell-content">
                                <div class="number-row">
                                    <span class="number">{{ $item }}.</span>
                                    @if ($item % 2 == 0)
                                        <!-- Cek apakah nomor genap -->
                                        <span class="label">Berangkat dari</span>
                                        <span class="separator">:</span>
                                    @else
                                        <span class="label">Tiba di</span>
                                        <span class="separator">:</span>
                                    @endif
                                </div>
                                @if ($item % 2 == 0)
                                    <!-- Cek jika genap -->
                                    <div class="row">
                                        <span class="label">Ke</span>
                                        <span class="separator">:</span>
                                    </div>
                                    <div class="row">
                                        <span class="label">Tanggal</span>
                                        <span class="separator">:</span>
                                    </div>
                                @else
                                    <div class="row">
                                        <span class="label">Pada tanggal</span>
                                        <span class="separator">:</span>
                                    </div>
                                @endif
                            </div>
                        </td>
                    @endforeach
                    {{-- Tambahkan kolom kosong jika pasangan tidak lengkap --}}
                    @if (count($pair) < 2)
                        <td></td>
                    @endif
                </tr>
            @endforeach
        </table>

        <div class="signature">
            <table>
                <tr>
                    <td>
                        <div class="identitas">
                            <p class="mb-1"> An. <span class="uppercase">Kepala Dinas
                                    Pekerjaan Umum dan
                                    <br>
                                    Penataan Ruang Kabupaten Aceh Barat</span>
                            </p>
                            <p class="">Plt. <span class="uppercase">Kasubbag Umum dan Kepegawaian</span></p>
                            <p class="uppercase nama text-underline fw-bold">
                                Suhendri Arba, ST., MT
                            </p>
                            <p class="mt-1">
                                Pembina Muda Tk. I
                            </p>
                            <p>NIP. 19850331 201003 1 001</p>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </main>

    <script>
        const url = "{{ route('surat-tugas.index') }}";
        window.print();
        window.onafterprint = function() {
            window.location.href = url;
        };
    </script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Tugas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/print.css') }}">
    <style>
        @media screen {
            body {
                margin: 5em;
                height: 210mm;
            }
        }

        @media print {
            @page {
                size: 'A4';
            }
        }
    </style>
</head>

<body>
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
                    <h6 class="uppercase">Surat Tugas</h6>
                    <p>Nomor : 090/<span
                            class="nomor__agenda"></span>/ST/{{ romawi($data['bulan']) }}/{{ $data['tahun'] }}</p>
                </div>
                <div class="isi">
                    <ol class="text-left">
                        <li>Kepala Dinas Pekerjaan Umum dan Penataan Ruang Kabupaten Aceh Barat, dengan ini menugaskan
                            Pegawai Negeri Sipil (PNS) yang namanya tersebut dibawah ini :</li>
                        <li class="no-marker">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th></th>
                                        <th>Nama/NIP</th>
                                        <th>Pangkat/Jabatan</th>
                                    </tr>
                                    <tr class="tfooter">
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['pegawai'] as $pegawai)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <p>{{ $pegawai->nama }}</p>
                                                <p>NIP. {{ $pegawai->nip_baru }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $pegawai->golongan?->pangkat_jabatan }}</p>
                                                <p>{{ ucwords(strtolower($pegawai->jabatan)) }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </li>
                    </ol>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>

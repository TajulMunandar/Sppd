<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export</title>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {
            font-weight: bold;
        }

        .header-table {
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        hr {
            border-top: 2px solid #000;
        }
    </style>
</head>

<body style="padding-left: 0px 20px 0px 20px; ">
<table>
    <tbody width="100%">
    <tr>
        <td>

        </td>
        <td>
            <div style=" font-weight: 600; margin-left: 20px">
                Nama OPD : DINAS PEKERJAAN UMUM DAN PENATAAN RUANG KAB. ACEH BARAT<br>
            </div>
        </td>
    </tr>
    </tbody>
</table>

<table class="table" style="width: 100%;">
    <thead>
    <tr>
        <th rowspan="3">No</th>
        <th colspan="14">SURAT TUGAS/PERJALANAN DINAS (S.P.T)</th>
        <th colspan="8">UANG HARIAN / REPRESENTASI</th>
        <th colspan="13">AKOMODASI HOTEL / TRANSPORT</th>
        <th colspan="8">TIKET PERGI</th>
        <th colspan="8">TIKET PULANG</th>
        <th rowspan="3">TOTAL BIAYA (Rp) ^^</th>
    </tr>
    <tr>
        <th rowspan="2">NOMOR SP2D</th>
        <th rowspan="2">NAMA PEGAWAI YANG BERANGKAT</th>
        <th rowspan="2">JABATAN</th>
        <th rowspan="2">GOLONGAN</th>
        <th rowspan="2">NOMOR ST/SPT</th>
        <th rowspan="2">NOMOR SPD</th>
        <th rowspan="2">KEGIATAN</th>
        <th colspan="2">LOKASI</th>
        <th rowspan="2">NAMA KEGIATAN</th>
        <th rowspan="2">LAMA TUGAS (HARI)</th>
        <th rowspan="2">TANGGAL ST</th>
        <th rowspan="2">TANGGAL BERANGKAT</th>
        <th rowspan="2">TANGGAL HARUS KEMBALI</th>
        <th rowspan="2">UANG HARIAN (Rp)</th>
        <th rowspan="2">TOTAL UANG HARIAN (Rp)</th>
        <th rowspan="2">UANG KONSUMSI (Rp)</th>
        <th rowspan="2">TOTAL UANG KONSUMSI (Rp)</th>
        <th rowspan="2">TRANSPORTASI SETEMPAT (Rp)</th>
        <th rowspan="2">TOTAL TRANSPORTASI SETEMPAT (Rp)</th>
        <th rowspan="2">UANG REPRESENTASI (Rp)</th>
        <th rowspan="2">TOTAL UANG REPRESENTASI (Rp)</th>
        {{-- akomodasi --}}
        <th rowspan="2">NAMA HOTEL</th>
        <th rowspan="2">TANGGAL CHEK IN</th>
        <th rowspan="2">TANGGAL CHEK OUT</th>
        <th rowspan="2">NO. INVOICE</th>
        <th rowspan="2">NOMOR KAMAR</th>
        <th rowspan="2">LAMA INAP</th>
        <th rowspan="2">ATAS NAMA KUITANSI HOTEL</th>
        <th rowspan="2">HARGA PER MALAM (Rp)</th>
        <th rowspan="2">HARGA PER MALAM (30%) (Rp)</th>
        <th rowspan="2">TOTAL UANG HOTEL (Rp)</th>
        <th rowspan="2">BBM/TRANSPOR KELUAR DAERAH (Rp)</th>
        <th colspan="2">TRANSPORT BANDARA (Rp)</th>
        {{-- pergi --}}
        <th rowspan="2">ASAL/FROM/ORIGIN</th>
        <th rowspan="2">TUJUAN/TO/DESTINATION</th>
        <th rowspan="2">TANGGAL PENERBANGAN</th>
        <th rowspan="2">MASKAPAI</th>
        <th rowspan="2">BOOKING REFERENCE (KODE BOOKING)</th>
        <th rowspan="2">No Eticket</th>
        <th rowspan="2">NO. PENERBANGAN</th>
        <th rowspan="2">TOTAL HARGA TIKET (Rp)</th>
        {{-- pulang --}}
        <th rowspan="2">ASAL/FROM/ORIGIN</th>
        <th rowspan="2">TUJUAN/TO/DESTINATION</th>
        <th rowspan="2">TANGGAL PENERBANGAN</th>
        <th rowspan="2">MASKAPAI</th>
        <th rowspan="2">BOOKING REFERENCE (KODE BOOKING)</th>
        <th rowspan="2">No Eticket</th>
        <th rowspan="2">NO. PENERBANGAN</th>
        <th rowspan="2">TOTAL HARGA TIKET (Rp)</th>
    </tr>
    <tr>
        <th>DARI</th>
        <th>TUJUAN PERJALANAN DINAS</th>
        <th>DARI (PP)</th>
        <th>KE (PP)</th>
    </tr>
    </thead>
    <thead>
    <tr>
        <th>1</th>
        <th>2</th>
        <th>3</th>
        <th>4</th>
        <th>5</th>
        <th>6</th>
        <th>7</th>
        <th>8</th>
        <th>9</th>
        <th>10</th>
        <th>11</th>
        <th>12</th>
        <th>13</th>
        <th>14</th>
        <th>15</th>
        <th>16</th>
        <th>17 = (12x16)</th>
        <th>18</th>
        <th>19 = (12x18)</th>
        <th>20</th>
        <th>21 = (12x20)</th>
        <th>22</th>
        <th>23 = (12x22)</th>
        <th>24</th>
        <th>25</th>
        <th>26</th>
        <th>27</th>
        <th>28</th>
        <th>29</th>
        <th>30</th>
        <th>31</th>
        <th>32</th>
        <th>33 = (29x3+32)</th>
        <th>34</th>
        <th>35</th>
        <th>36</th>
        <th>37</th>
        <th>38</th>
        <th>39</th>
        <th>40</th>
        <th>41</th>
        <th>42</th>
        <th>43</th>
        <th>44</th>
        <th>45</th>
        <th>46</th>
        <th>47</th>
        <th>48</th>
        <th>49</th>
        <th>50</th>
        <th>51</th>
        <th>52</th>
        <th>53 = 17+19+20+21+23+33+34+35+36+4+52</th>
    </tr>
    </thead>

    <tbody>
    @php
        $i = 1;
    @endphp
    @foreach($sppd->pegawais as $pegawai)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $sppd->suratTugas?->first()->nomor_spd }}</td>
            <td>{{ $pegawai->nama }}</td>
            <td>{{ $pegawai->jabatan }}</td>
            <td>{{ $pegawai->golongan->kode }}</td>
            <td>{{ $sppd->suratTugas?->first()->nomor_st }}</td>
            <td>{{ $sppd->suratTugas?->first()->nomor_spd }}</td>
            <td>{{ $sppd->suratTugas?->first()->kegiatan }}</td>
            <td>{{ $sppd->suratTugas?->first()->dari }}</td>
            <td>{{ $sppd->suratTugas?->first()->tujuan }}</td>
            <td>{{ $sppd->suratTugas?->first()->nama_kegiatan }}</td>
            <td>{{ $sppd->suratTugas?->first()->lama_tugas }}</td>
            <td>{{ $sppd->suratTugas?->first()->tanggal }}</td>
            <td>{{ $sppd->suratTugas?->first()->tanggal_berangkat }}</td>
            <td>{{ $sppd->suratTugas?->first()->tanggal_kembali }}</td>
            <td>{{ $sppd->uangHarian?->first()->harian }}</td>
            <td>{{ $sppd->uangHarian?->first()->total_harian }}</td>
            <td>{{ $sppd->uangHarian?->first()->konsumsi }}</td>
            <td>{{ $sppd->uangHarian?->first()->total_konsumsi }}</td>
            <td>{{ $sppd->uangHarian?->first()->transportasi }}</td>
            <td>{{ $sppd->uangHarian?->first()->total_transportasi }}</td>
            <td>{{ $sppd->uangHarian?->first()->representasi }}</td>
            <td>{{ $sppd->uangHarian?->first()->total_representasi }}</td>
            <td>{{ $sppd->akomodasi?->first()->name_hotel }}</td>
            <td>{{ $sppd->akomodasi?->first()->tgl_masuk }}</td>
            <td>{{ $sppd->akomodasi?->first()->tgl_keluar }}</td>
            <td>{{ $sppd->akomodasi?->first()->no_invoice }}</td>
            <td>{{ $sppd->akomodasi?->first()->no_kamar }}</td>
            <td>{{ $sppd->akomodasi?->first()->lama_inap }}</td>
            <td>{{ $sppd->akomodasi?->first()->nama_kwitansi }}</td>
            <td>{{ $sppd->akomodasi?->first()->harga_permalam }}</td>
            <td>{{ $sppd->akomodasi?->first()->harga_permalam2 }}</td>
            <td>{{ $sppd->akomodasi?->first()->total_uang }}</td>
            <td>{{ $sppd->akomodasi?->first()->bbm }}</td>
            <td>{{ $sppd->akomodasi?->first()->dari }}</td>
            <td>{{ $sppd->akomodasi?->first()->ke }}</td>
            <td>{{ $sppd->totalPergi?->first()->asal }}</td>
            <td>{{ $sppd->totalPergi?->first()->tujuan }}</td>
            <td>{{ $sppd->totalPergi?->first()->tgl_penerbangan }}</td>
            <td>{{ $sppd->totalPergi?->first()->maskapai }}</td>
            <td>{{ $sppd->totalPergi?->first()->booking_reference }}</td>
            <td>{{ $sppd->totalPergi?->first()->no_eticket }}</td>
            <td>{{ $sppd->totalPergi?->first()->no_penerbangan }}</td>
            <td>{{ $sppd->totalPergi?->first()->total_harga }}</td>
            <td>{{ $sppd->totalPulang?->first()->asal }}</td>
            <td>{{ $sppd->totalPulang?->first()->tujuan }}</td>
            <td>{{ $sppd->totalPulang?->first()->tgl_penerbangan }}</td>
            <td>{{ $sppd->totalPulang?->first()->maskapai }}</td>
            <td>{{ $sppd->totalPulang?->first()->booking_reference }}</td>
            <td>{{ $sppd->totalPulang?->first()->no_eticket }}</td>
            <td>{{ $sppd->totalPulang?->first()->no_penerbangan }}</td>
            <td>{{ $sppd->totalPulang?->first()->total_harga }}</td>
            @php
                $total = $sppd->uangHarian?->first()->total_harian + $sppd->uangHarian?->first()->total_konsumsi
                         + $sppd->uangHarian?->first()->total_transportasi + $sppd->uangHarian?->first()->total_representasi
                         + $sppd->akomodasi?->first()->total_uang + $sppd->totalPergi?->first()->total_harga
                         + $sppd->totalPulang?->first()->total_harga;
            @endphp
            <td>{{ $total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>


</body>

</html>

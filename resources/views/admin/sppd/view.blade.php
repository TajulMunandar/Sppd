<x-app-layout :$title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Data SPPD Lengkap</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="text-center align-middle">
                            <tr>
                                <th rowspan="3">No</th>
                                <th colspan="13">SURAT TUGAS/PERJALANAN DINAS (S.P.T)</th>
                                <th colspan="8">UANG HARIAN / REPRESENTASI</th>
                                <th colspan="13">AKOMODASI HOTEL / TRANSPORT</th>
                                <th colspan="8">TIKET PERGI</th>
                                <th colspan="8">TIKET PULANG</th>
                                <th rowspan="3">TOTAL BIAYA (Rp)</th>
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
                        <thead class="text-sm text-center align-middle">
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
                                <th>16 = (11x16)</th>
                                <th>17</th>
                                <th>18 = (11x18)</th>
                                <th>19</th>
                                <th>20 = (11x20)</th>
                                <th>21</th>
                                <th>22 = (11x22)</th>
                                <th>23</th>
                                <th>24</th>
                                <th>25</th>
                                <th>26</th>
                                <th>27</th>
                                <th>28</th>
                                <th>29</th>
                                <th>30</th>
                                <th>31</th>
                                <th>32 = (28x30+31)</th>
                                <th>33</th>
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
                                <th>52 = 17+19+20+21+23+33+34+4+52</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($sppds as $sppd)
                                @php
                                    $total_harian = $sppd->uangHarian?->harian * $sppd->suratTugas?->lama_tugas;
                                    $total_konsumsi = $sppd->uangHarian?->konsumsi * $sppd->suratTugas?->lama_tugas;
                                    $total_transportasi = $sppd->uangHarian?->total_transportasi;
                                    $total_representasi = $sppd->uangHarian?->representasi;
                                @endphp
                                @foreach ($sppd->pegawais as $pegawai)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $sppd->nomor_sp2d }}</td>
                                        <td class="text-nowrap">{{ $pegawai->nama }}</td>
                                        <td>{{ $pegawai->jabatan }}</td>
                                        <td align="center">{{ $pegawai->golongan->kode }}</td>
                                        <td>{{ $sppd->suratTugas?->nomor_st }}</td>
                                        <td>{{ $sppd->suratTugas?->nomor_spd }}</td>
                                        <td>{{ $sppd->suratTugas?->kegiatan }}</td>
                                        <td>{{ $sppd->suratTugas?->dari }}</td>
                                        <td>{{ $sppd->suratTugas?->tujuan }}</td>
                                        <td>{{ $sppd->suratTugas?->lama_tugas }}</td>
                                        <td align="center">{{ $sppd->suratTugas?->tanggal_st->format('d/m/Y') }}
                                        </td>
                                        <td align="center">
                                            {{ $sppd->suratTugas?->tanggal_berangkat->format('d/m/Y') }}</td>
                                        <td align="center">
                                            {{ $sppd->suratTugas?->tanggal_kembali->format('d/m/Y') }}</td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($sppd->uangHarian?->harian, 0, ',', '.') }}
                                        </td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($total_harian, 0, ',', '.') }}
                                        </td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($sppd->uangHarian?->konsumsi, 0, ',', '.') }}</td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($total_konsumsi, 0, ',', '.') }}</td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($sppd->uangHarian?->transportasi, 0, ',', '.') }}</td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($total_transportasi, 0, ',', '.') }}</td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ $pegawai->jabatan == 'KEPALA DINAS' ? number_format($sppd->uangHarian?->representasi, 0, ',', '.') : 0 }}
                                        </td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ $pegawai->jabatan == 'KEPALA DINAS' ? number_format($total_representasi, 0, ',', '.') : 0 }}
                                        </td>
                                        <td>{{ $sppd->akomodasi?->nama_hotel }}</td>
                                        <td align="center">{{ $sppd->akomodasi?->check_in?->format('d/m/Y') }}</td>
                                        <td align="center">{{ $sppd->akomodasi?->check_out?->format('d/m/Y') }}</td>
                                        <td>{{ $sppd->akomodasi?->nomor_invoice }}</td>
                                        <td>{{ $sppd->akomodasi?->nomor_kamar }}</td>
                                        <td align="center">{{ $sppd->akomodasi?->lama_inap }}</td>
                                        <td>{{ $sppd->akomodasi?->nama_kwitansi }}</td>
                                        <td>{{ number_format($sppd->akomodasi?->harga, 0, ',', '.') }}</td>
                                        <td>{{ number_format($sppd->akomodasi?->harga_diskon, 0, ',', '.') }}</td>
                                        @php
                                            $total_uang =
                                                $sppd->akomodasi?->lama_inap * $sppd->akomodasi?->harga +
                                                $sppd->akomodasi?->harga_diskon;
                                        @endphp
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($total_uang, 0, ',', '.') }}</td>
                                        <td align="right" data-format="Rp #,##0">
                                            {{ number_format($sppd->akomodasi?->bbm, 0, ',', '.') }}</td>
                                        <td>{{ $sppd->akomodasi?->dari }}</td>
                                        <td>{{ $sppd->akomodasi?->ke }}</td>
                                        <td>{{ $sppd->totalPergi?->asal }}</td>
                                        <td>{{ $sppd->totalPergi?->tujuan }}</td>
                                        <td align="center">
                                            {{ $sppd->totalPergi?->tgl_penerbangan->format('d/m/Y') }}</td>
                                        <td>{{ $sppd->totalPergi?->maskapai }}</td>
                                        <td>{{ $sppd->totalPergi?->booking_reference }}</td>
                                        <td>{{ $sppd->totalPergi?->no_eticket }}</td>
                                        <td>{{ $sppd->totalPergi?->no_penerbangan }}</td>
                                        <td>{{ $sppd->totalPergi?->total_harga }}</td>
                                        <td>{{ $sppd->totalPulang?->asal }}</td>
                                        <td>{{ $sppd->totalPulang?->tujuan }}</td>
                                        <td align="center">
                                            {{ $sppd->totalPulang?->tgl_penerbangan->format('d/m/Y') }}</td>
                                        <td>{{ $sppd->totalPulang?->maskapai }}</td>
                                        <td>{{ $sppd->totalPulang?->booking_reference }}</td>
                                        <td>{{ $sppd->totalPulang?->no_eticket }}</td>
                                        <td>{{ $sppd->totalPulang?->no_penerbangan }}</td>
                                        <td>{{ number_format($sppd->totalPulang?->total_harga, 0, ',', '.') }}</td>
                                        @php
                                            $total =
                                                $total_harian +
                                                $total_konsumsi +
                                                $total_transportasi +
                                                $total_representasi +
                                                $total_uang +
                                                $sppd->akomodasi?->bbm +
                                                $sppd->totalPergi?->total_harga +
                                                $sppd->totalPulang?->total_harga;
                                        @endphp
                                        <td class="text-right" data-format="Rp #,##0">
                                            {{ number_format($sppd->total_biaya, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

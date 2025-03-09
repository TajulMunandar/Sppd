-- Active: 1705378548033@@127.0.0.1@3306@emonev
<x-app-layout :$title>
    <div class="gy-3 row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Pegawai</th>
                                    <th>Perihal</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal Berangkat</th>
                                    <th>Tanggal Kembali</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @foreach (json_decode($item->pegawai) as $pelaksana)
                                                {{ $pelaksana }}<br>
                                            @endforeach
                                        </td>
                                        <td>{{ $item->perihal }}</td>
                                        <td>{{ $item->tujuan }}</td>
                                        <td>{{ $item->tanggal_berangkat->format('d/m/Y') }}</td>
                                        <td>{{ $item->tanggal_kembali->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

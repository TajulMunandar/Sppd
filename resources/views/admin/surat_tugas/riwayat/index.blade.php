<x-app-layout :$title>
    <div class="gy-3 row">
        <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Pegawai</th>
                                    <th>Perihal</th>
                                    <th>Tujuan</th>
                                    <th>Tanggal Berangkat</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('surat-tugas.riwayat.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'pegawai',
                            name: 'pegawai',
                            orderable: false
                        },
                        {
                            data: 'perihal',
                            name: 'perihal'
                        },
                        {
                            data: 'tujuan',
                            name: 'tujuan'
                        },
                        {
                            data: 'tanggal_berangkat',
                            name: 'tanggal_berangkat'
                        },
                        {
                            data: 'tanggal_kembali',
                            name: 'tanggal_kembali'
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    columnDefs: [{
                        className: "text-center",
                        targets: [6]
                    }]
                });
            });
        </script>
    @endpush
</x-app-layout>

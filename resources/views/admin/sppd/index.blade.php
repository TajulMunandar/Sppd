<x-app-layout :$title>
    <div class="row">
        <div class="col">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <a class="text-white btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSppd">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </a>
            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-switch" class="btn btn-success"><i
                    class="fa fa-file"></i> Export</button>

            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table align-middle responsive table-bordered table-striped"
                        style="width:100%">
                        <thead class="align-middle">
                            <tr>
                                <th>#</th>
                                <th>Nomor SP2D</th>
                                <th>Kode Kegiatan</th>
                                <th>Pegawai</th>
                                <th>Jenis Tugas</th>
                                <th>Total Biaya</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sppds as $sppd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sppd->nomor_sp2d }}</td>
                                    <td>
                                        <div style="min-width: 300px">{{ $sppd->kegiatan }}</div>
                                    </td>
                                    <td class="text-nowrap">
                                        <ul class="mb-0 list-unstyled" style="list-style-type: -">
                                            @foreach ($sppd->pegawais as $pegawai)
                                                <li>- {{ $pegawai->nama_lengkap }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $sppd->JenisTugas->name }}</td>
                                    <td class="text-nowrap text-end">
                                        Rp. {{ number_format($sppd->total_biaya, 0, ',', '.') }}</td>
                                    <td class="text-center text-nowrap">
                                        <a class="text-white btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#detailSppd{{ $loop->iteration }}">
                                            <i class="fa-regular fa-list"></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning" href="{{ route('sppd.edit', $sppd->id) }}">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusSppd{{ $loop->iteration }}">
                                            <i class="fa-regular fa-trash-can fa-lg"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Hapus sppd --}}
                                <x-form_modal>
                                    @slot('id', "hapusSppd$loop->iteration")
                                    @slot('title', 'Hapus Data Sppd')
                                    @slot('route', route('sppd.destroy', $sppd->id))
                                    @slot('method')
                                        @method('delete')
                                    @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Sppd
                                        <b>{{ $sppd->nomor_sp2d }}</b>?
                                    </p>

                                </x-form_modal>
                                {{-- / Modal Hapus sppd  --}}

                                <!-- Modal -->
                                <div class="modal fade" id="detailSppd{{ $loop->iteration }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Detail Sppd
                                                </h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="fs-3">
                                                    <b>{{ $sppd->name }}</b>
                                                </p>
                                                <div class="row">
                                                    <div class="mb-2 col-lg-4">
                                                        <a href="{{ route('surat.detail', $sppd->id) }}">
                                                            <div class="shadow card">
                                                                <div class="text-center card-body">
                                                                    Surat Tugas
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a href="{{ route('akomodasi.detail', $sppd->id) }}">
                                                            <div class="shadow card">
                                                                <div class="text-center card-body">
                                                                    Akomodasi
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a href="{{ route('uang.detail', $sppd->id) }}">
                                                            <div class="shadow card">
                                                                <div class="text-center card-body">
                                                                    Uang Harian
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a href="{{ route('pergi.detail', $sppd->id) }}">
                                                            <div class="shadow card">
                                                                <div class="text-center card-body">
                                                                    Tiket Pergi
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a href="{{ route('pulang.detail', $sppd->id) }}">
                                                            <div class="shadow card">
                                                                <div class="text-center card-body">
                                                                    Tiket Pulang
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div class="mb-2 col-lg-4">
                                                        <a href="{{ route('dokumen-st.index', $sppd->id) }}">
                                                            <div class="shadow card">
                                                                <div class="text-center card-body">
                                                                    Upload ST
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah jenis -->
    <x-form_modal>
        @slot('id', 'tambahSppd')
        @slot('title', 'Tambah Data Sppd')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('sppd.store'))
        <div class="row">
            <div class="mb-3">
                <label for="jenis_tugas_id" class="form-label">Jenis Tugas</label>
                <select class="form-select @error('jenis_tugas_id') is-invalid @enderror" id="jenis_tugas_id"
                    name="jenis_tugas_id" required>
                    <option value="">-- pilih --</option>
                    @foreach ($jenises as $jenis)
                        <option value="{{ $jenis->id }}">
                            {{ $jenis->name }}
                        </option>
                    @endforeach
                </select>
                @error('jenis_tugas_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nomor" class="form-label">Nomor SP2D</label>
                <input type="text" name="nomor_sp2d" id="nomor"
                    class="form-control @error('nomor_sp2d') is-invalid @enderror" required>
                @error('nomor_sp2d')
                    <div class="invalid_feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="pegawai" class="form-label">Nama Pegawai</label>
                <select class="form-select select2 @error('pegawai') is-invalid @enderror" id="pegawai"
                    multiple="multiple" name="pegawai[]" style="width: 100%" required>
                    <option value="">-- pilih pegawai --</option>
                    @foreach ($users as $pegawai)
                        <option value="{{ $pegawai->id }}">{{ $pegawai->nama_lengkap }}</option>
                    @endforeach
                </select>
                @error('pegawai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kode Kegiatan</label>
                <input type="text" name="kegiatan" id="kegiatan"
                    class="form-control @error('kegiatan') is-invalid @enderror" required>
                @error('kegiatan')
                    <div class="invalid_feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="biaya" class="form-label">Total Biaya</label>
                <div class="input-group">
                    <div class="input-group-text">
                        Rp.
                    </div>
                    <input type="text" class="form-control @error('total_biaya') is-invalid @enderror"
                        id="biaya" name="total_biaya" required>
                </div>
                @error('total_biaya')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text" id="basic-addon4">Kosongkan jika belum mempunyai total</div>
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah jenis -->

    {{-- Modal export --}}
    <x-modal-content-only id="modal-switch">
        @slot('title', 'Pilih Jenis SPPD')
        <div class="row">
            @foreach ($jenises as $jenis)
                <div class="col">
                    <a href="{{ route('sppd.export-all', $jenis->id) }}">
                        <div class="transition-shadow duration-300 shadow-lg-hover card">
                            <div class="text-center card-body">
                                {{ $jenis->name }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </x-modal-content-only>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('libs/mask-money/jquery.maskMoney.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    dropdownParent: $('#tambahSppd'),
                    placeholder: '-- pilih pegawai --',
                    allowClear: true
                });
                $('#biaya, #total_biaya').maskMoney({
                    thousands: '.',
                    decimal: ',',
                    allowZero: true,
                    precision: 0
                });
            });
        </script>
    @endpush
</x-app-layout>

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
        <div class="col">
            <a class="btn btn-outline-secondary" href="{{ route('sppd.index') }}">
                <i class="fa-regular fa-chevron-left me-2"></i>
                Kembali
            </a>
            <a class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#tambahSppd">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </a>
            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                           style="width:100%">
                        <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>Nama Hotel</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>No Invoice</th>
                            <th>No Kamar</th>
                            <th>Lama Inap</th>
                            <th>Nama Kwitansi</th>
                            <th>Harga Permalam</th>
                            <th>Harga Permalam (30%)</th>
                            <th>BBM</th>
                            <th>Dari</th>
                            <th>Ke</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($akomodasis as $akomodasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $akomodasi->name_hotel ?: '-' }}</td>
                                <td class="text-center">{{ $akomodasi->check_in?->format('d/m/Y') ?:'-' }}</td>
                                <td class="text-center">{{ $akomodasi->check_out?->format('d/m/Y') ?:'-' }}</td>
                                <td>{{ $akomodasi->nomor_invoice ?:'-' }}</td>
                                <td class="text-center">{{ $akomodasi->nomor_kamar?:'-' }}</td>
                                <td class="text-center">{{ $akomodasi->lama_inap?:'-' }}</td>
                                <td>{{ $akomodasi->nama_kwitansi?:'-' }}</td>
                                <td class="text-end">Rp. {{ number_format($akomodasi->harga, 0, ',', '.') }}</td>
                                <td class="text-end">Rp. {{ number_format($akomodasi->harga_diskon, 0, ',', '.') }}</td>
                                <td class="text-end">Rp. {{ number_format($akomodasi->bbm, 0, ',', '.') }}</td>
                                <td>{{ $akomodasi->dari }}</td>
                                <td>{{ $akomodasi->ke }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editSppd{{ $loop->iteration }}">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusSppd{{ $loop->iteration }}">
                                        <i class="fa-regular fa-trash-can fa-lg"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal Edit sppd --}}
                            <x-form_modal>
                                @slot('id', "editSppd$loop->iteration")
                                @slot('title', 'Edit Data Akomodasi')
                                @slot('route', route('akomodasi.update', $akomodasi->id))
                                @slot('method')
                                    @method('put')
                                @endslot
                                @slot('btnPrimaryTitle', 'Perbarui')

                                @csrf
                                <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
                                <div class="mb-3">
                                    <label for="name_hotel" class="form-label">Nama Hotel</label>
                                    <input type="text"
                                           class="form-control @error('name_hotel') is-invalid @enderror"
                                           name="nama_hotel" id="name_hotel"
                                           value="{{ old('name_hotel', $akomodasi->nama_hotel) }}" autofocus>
                                    @error('name_hotel')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="check_in" class="form-label">Tanggal Masuk</label>
                                    <input type="date"
                                           class="form-control @error('check_in') is-invalid @enderror" name="check_in"
                                           id="check_in"
                                           value="{{ old('check_in', $akomodasi->check_in?->format('Y-m-d')) }}">
                                    @error('check_in')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="check_out" class="form-label">Tanggal Keluar</label>
                                    <input type="date"
                                           class="form-control @error('check_out') is-invalid @enderror"
                                           name="check_out" id="check_out"
                                           value="{{ old('check_out', $akomodasi->check_out?->format('Y-m-d')) }}">
                                    @error('check_out')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_invoice" class="form-label">No Invoice</label>
                                    <input type="text"
                                           class="form-control @error('nomor_invoice') is-invalid @enderror"
                                           name="nomor_invoice" id="nomor_invoice"
                                           value="{{ old('nomor_invoice', $akomodasi->nomor_invoice) }}">
                                    @error('nomor_invoice')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_kamar" class="form-label">No Kamar</label>
                                    <input type="text"
                                           class="form-control @error('nomor_kamar') is-invalid @enderror"
                                           name="nomor_kamar" id="nomor_kamar"
                                           value="{{ old('nomor_kamar', $akomodasi->nomor_kamar) }}">
                                    @error('nomor_kamar')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lama_inap" class="form-label">Lama Inap</label>
                                    <input type="number" max="50"
                                           class="form-control @error('lama_inap') is-invalid @enderror"
                                           name="lama_inap" id="lama_inap"
                                           value="{{ old('lama_inap', $akomodasi->lama_inap) }}">
                                    @error('lama_inap')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nama_kwitansi" class="form-label">Nama Kwitansi</label>
                                    <input type="text"
                                           class="form-control @error('nama_kwitansi') is-invalid @enderror"
                                           name="nama_kwitansi" id="nama_kwitansi"
                                           value="{{ old('nama_kwitansi', $akomodasi->nama_kwitansi) }}">
                                    @error('nama_kwitansi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga Permalam</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input type="text"
                                               class="form-control @error('harga') is-invalid @enderror" name="harga"
                                               id="harga" value="{{ old('harga', $akomodasi->harga) }}">
                                    </div>
                                    @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="harga_diskon" class="form-label">Harga Permalam (30%)</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input type="text"
                                               class="form-control @error('harga_diskon') is-invalid @enderror"
                                               name="harga_diskon" id="harga_diskon"
                                               value="{{ old('harga_diskon', $akomodasi->harga_diskon) }}">
                                    </div>
                                    @error('harga_diskon')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="bbm" class="form-label">BBM</label>
                                    <div class="input-group">
                                        <div class="input-group-text">Rp.</div>
                                        <input type="text" class="form-control @error('bbm') is-invalid @enderror"
                                               name="bbm" id="bbm" value="{{ old('bbm', $akomodasi->bbm) }}"
                                               required>
                                    </div>
                                    @error('bbm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="text"
                                           class="form-control @error('dari') is-invalid @enderror" name="dari"
                                           id="dari" value="{{ old('dari', $akomodasi->dari) }}" required>
                                    @error('dari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ke" class="form-label">Ke</label>
                                    <input type="text" class="form-control @error('ke') is-invalid @enderror"
                                           name="ke" id="ke" value="{{ old('ke', $akomodasi->ke) }}"
                                           required>
                                    @error('ke')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                            </x-form_modal>
                            {{-- / Modal Edit sppd --}}

                            {{-- Modal Hapus sppd --}}
                            <x-form_modal>
                                @slot('id', "hapusSppd$loop->iteration")
                                @slot('title', 'Hapus Data Akomodasi')
                                @slot('route', route('akomodasi.destroy', $akomodasi->id))
                                @slot('method')
                                    @method('delete')
                                @endslot
                                @slot('btnPrimaryClass', 'btn-outline-danger')
                                @slot('btnSecondaryClass', 'btn-secondary')
                                @slot('btnPrimaryTitle', 'Hapus')

                                <p class="fs-5">Apakah anda yakin akan menghapus data Akomodasi
                                    <b>{{ $akomodasi->name_hotel }}</b>?
                                </p>

                            </x-form_modal>
                            {{-- / Modal Hapus sppd  --}}
                        @endforeach
                        </tbody>
                    </table>
                    {{-- End Table --}}
                </div>
            </div>
        </div>
    </div>

    <x-form_modal>
        @slot('id', 'tambahSppd')
        @slot('title', 'Tambah Data Sppd')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('akomodasi.detailStore'))

        @csrf

        <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
        <div class="mb-3">
            <label for="name_hotel" class="form-label">Nama Hotel</label>
            <input type="text" name="name_hotel" class="form-control @error('name_hotel') is-invalid @enderror"
                   id="name_hotel" value="{{ old('name_hotel') }}" autofocus>
            @error('name_hotel')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="check_in" class="form-label">Tanggal Masuk</label>
            <input type="date" class="form-control @error('check_in') is-invalid @enderror" name="check_in"
                   id="check_in" value="{{ old('check_in') }}">
            @error('check_in')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="check_out" class="form-label">Tanggal Keluar</label>
            <input type="date" class="form-control @error('check_out') is-invalid @enderror" name="check_out"
                   id="check_out" value="{{ old('check_out') }}">
            @error('check_out')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nomor_invoice" class="form-label">No Invoice</label>
            <input type="text" class="form-control @error('nomor_invoice') is-invalid @enderror" name="nomor_invoice"
                   id="nomor_invoice" value="{{ old('nomor_invoice') }}">
            @error('nomor_invoice')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nomor_kamar" class="form-label">No Kamar</label>
            <input type="text" class="form-control @error('nomor_kamar') is-invalid @enderror" name="nomor_kamar"
                   id="nomor_kamar" value="{{ old('nomor_kamar') }}">
            @error('nomor_kamar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="lama_inap" class="form-label">Lama Inap</label>
            <input type="number" min="1" step="1" max="50" class="form-control @error('lama_inap') is-invalid @enderror"
                   name="lama_inap" id="lama_inap" value="{{ old('lama_inap') }}">
            @error('lama_inap')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nama_kwitansi" class="form-label">Nama Kwitansi</label>
            <input type="text" class="form-control @error('nama_kwitansi') is-invalid @enderror"
                   name="nama_kwitansi" id="nama_kwitansi" value="{{ old('nama_kwitansi') }}">
            @error('nama_kwitansi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga" class="form-label">Harga Permalam</label>
            <div class="input-group">
                <div class="input-group-text">Rp.</div>
                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                       name="harga" id="harga" value="{{ old('harga') }}">
            </div>
            @error('harga')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="harga_diskon" class="form-label">Harga Permalam (30%)</label>
            <div class="input-group">
                <div class="input-group-text">Rp.</div>
                <input type="text" class="form-control @error('harga_diskon') is-invalid @enderror"
                       name="harga_diskon" id="harga_diskon" value="{{ old('harga_diskon') }}">
            </div>
            @error('harga_diskon')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="bbm" class="form-label">BBM</label>
            <div class="input-group">
                <div class="input-group-text">Rp.</div>
                <input type="text" class="form-control @error('bbm') is-invalid @enderror" name="bbm"
                       id="bbm" value="{{ old('bbm') }}" required>
            </div>
            @error('bbm')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="dari" class="form-label">Dari</label>
            <input type="text" class="form-control @error('dari') is-invalid @enderror" name="dari"
                   id="dari" value="{{ old('dari') }}" required>
            @error('dari')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ke" class="form-label">Ke</label>
            <input type="text" class="form-control @error('ke') is-invalid @enderror" name="ke"
                   id="ke" value="{{ old('ke') }}" required>
            @error('ke')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah surat -->

    @push('script')
        <script src="{{ asset('libs/mask-money/jquery.maskMoney.min.js') }}"></script>
        <script>
            $(document).ready(function () {
                const hargaField = $('#harga');

                function initMask() {
                    $('#harga, #harga_diskon, #bbm').maskMoney({
                        thousands: '.',
                        decimal: ',',
                        allowZero: true,
                        precision: 0
                    });
                }

                initMask();

                hargaField.on('blur', function () {
                    const harga = parseFloat($(this).val().replace(/\./g, '').replace(',', '.'));
                    const diskon = harga * 0.3;
                    // console.log(diskon, harga, $(this).val())
                    $('#harga_diskon').val(diskon).trigger('mask.maskMoney');
                });

                const harga = "{{ $akomodasi->harga ?? 0 }}";
                const hargaDiskon = "{{ $akomodasi->harga_diskon ?? 0 }}";
                const bbm = "{{ $akomodasi->bbm ?? 0 }}";
                hargaField.val(harga).trigger('mask.maskMoney');
                $('#harga_diskon').val(hargaDiskon).trigger('mask.maskMoney');
                $('#bbm').val(bbm).trigger('mask.maskMoney');
            });
        </script>
    @endpush
</x-app-layout>

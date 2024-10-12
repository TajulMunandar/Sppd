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

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6>Periksa kesalahan berikut:</h6>
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
            <a class="text-white btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah">
                <i class="fa-regular fa-plus me-2"></i>
                Tambah
            </a>

            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Asal</th>
                                <th>Tujuan</th>
                                <th>Tanggal Penerbangan</th>
                                <th>Maskapai</th>
                                <th>Booking Reference</th>
                                <th>No Eticket</th>
                                <th>No Penerbangan</th>
                                <th>Total Harga</th>
                                <th>Bukti Tiket</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pulangs as $pulang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pulang->asal }}</td>
                                    <td>{{ $pulang->tujuan }}</td>
                                    <td>{{ $pulang->tgl_penerbangan->format('d/m/Y') }}</td>
                                    <td>{{ $pulang->maskapai }}</td>
                                    <td>{{ $pulang->booking_reference }}</td>
                                    <td>{{ $pulang->no_eticket }}</td>
                                    <td>{{ $pulang->no_penerbangan }}</td>
                                    <td>Rp. {{ number_format($pulang->total_harga, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @if ($pulang->dokumen)
                                            <a href="{{ asset('storage/' . $pulang->dokumen) }}" target="_blank">
                                                <img src="{{ asset('icons/pdf.svg') }}" alt="file-{{ $pulang->id }}"
                                                    width="40">
                                            </a>
                                        @else
                                            -
                                        @endif
                                    </td>
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
                                <x-form_modal file>
                                    @slot('id', "editSppd$loop->iteration")
                                    @slot('title', 'Edit Data Tiket Pulang')
                                    @slot('route', route('pulang.update', $pulang->id))
                                    @slot('method')
                                        @method('put')
                                    @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    @csrf
                                    <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
                                    <div class="mb-3">
                                        <label for="asal" class="form-label">Asal</label>
                                        <input type="text" class="form-control @error('asal') is-invalid @enderror"
                                            name="asal" id="asal" value="{{ old('asal', $pulang->asal) }}"
                                            autofocus required>
                                        @error('asal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tujuan" class="form-label">Tujuan</label>
                                        <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                            name="tujuan" id="tujuan" value="{{ old('tujuan', $pulang->tujuan) }}"
                                            autofocus required>
                                        @error('tujuan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="tgl_penerbangan" class="form-label">Tanggal Penerbangan</label>
                                        <input type="date"
                                            class="form-control @error('tgl_penerbangan') is-invalid @enderror"
                                            name="tgl_penerbangan" id="tgl_penerbangan"
                                            value="{{ old('tgl_penerbangan', $pulang->tgl_penerbangan->format('Y-m-d')) }}"
                                            required>
                                        @error('tgl_penerbangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="maskapai" class="form-label">Maskapai</label>
                                        <input type="text"
                                            class="form-control @error('maskapai') is-invalid @enderror" name="maskapai"
                                            id="maskapai" value="{{ old('maskapai', $pulang->maskapai) }}" required>
                                        @error('maskapai')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="booking_reference" class="form-label">Booking Reference</label>
                                        <input type="text"
                                            class="form-control @error('booking_reference') is-invalid @enderror"
                                            name="booking_reference" id="booking_reference"
                                            value="{{ old('booking_reference', $pulang->booking_reference) }}"
                                            required>
                                        @error('booking_reference')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_eticket" class="form-label">No Eticket</label>
                                        <input type="text"
                                            class="form-control @error('no_eticket') is-invalid @enderror"
                                            name="no_eticket" id="no_eticket"
                                            value="{{ old('no_eticket', $pulang->no_eticket) }}" required>
                                        @error('no_eticket')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="no_penerbangan" class="form-label">No Penerbangan</label>
                                        <input type="text"
                                            class="form-control @error('no_penerbangan') is-invalid @enderror"
                                            name="no_penerbangan" id="no_penerbangan"
                                            value="{{ old('no_penerbangan', $pulang->no_penerbangan) }}" required>
                                        @error('no_penerbangan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_harga" class="form-label">Total Harga</label>
                                        <div class="input-group @error('total_harga') is-invalid @enderror">
                                            <div class="input-group-text">Rp.</div>
                                            <input type="text"
                                                class="form-control @error('total_harga') is-invalid @enderror"
                                                name="total_harga" id="total_harga"
                                                value="{{ old('total_harga', number_format($pulang->total_harga, 0, ',', '.')) }}"
                                                required>
                                        </div>
                                        @error('total_harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="dokumen" class="form-label">Bukti Tiket</label>
                                        <input type="file"
                                            class="form-control @error('dokumen') is-invalid @enderror" name="dokumen"
                                            id="dokumen" value="{{ old('dokumen') }}">
                                        @error('dokumen')
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
                                    @slot('title', 'Hapus Data Tiket Pulang')
                                    @slot('route', route('pulang.destroy', $pulang->id))
                                    @slot('method')
                                        @method('delete')
                                    @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Tiket Pulang
                                        <b>{{ $pulang->asal }}</b>?
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

    <!-- Modal Tambah surat -->
    <x-form_modal file>
        @slot('id', 'tambah')
        @slot('title', 'Tambah Data Tiket pulang')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('pulang.detailStore'))

        @csrf

        <div class="mb-3">
            <label for="asal" class="form-label">Asal</label>
            <input type="hidden" name="sppd_id" id="sppd_id" value="{{ $sppd->id }}">
            <input type="text" class="form-control @error('asal') is-invalid @enderror" name="asal"
                id="asal" value="{{ old('asal') }}" autofocus required>
            @error('asal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tujuan" class="form-label">Tujuan</label>
            <input type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan"
                id="tujuan" value="{{ old('tujuan') }}" required>
            @error('tujuan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tgl_penerbangan" class="form-label">Tanggal Penerbangan</label>
            <input type="date" class="form-control @error('tgl_penerbangan') is-invalid @enderror"
                name="tgl_penerbangan" id="tgl_penerbangan" value="{{ old('tgl_penerbangan') }}" required>
            @error('tgl_penerbangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="maskapai" class="form-label">Maskapai</label>
            <input type="text" class="form-control @error('maskapai') is-invalid @enderror" name="maskapai"
                id="maskapai" value="{{ old('maskapai') }}" required>
            @error('maskapai')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="booking_reference" class="form-label">Booking Reference</label>
            <input type="text" class="form-control @error('booking_reference') is-invalid @enderror"
                name="booking_reference" id="booking_reference" value="{{ old('booking_reference') }}" required>
            @error('booking_reference')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="no_eticket" class="form-label">No Eticket</label>
            <input type="text" class="form-control @error('no_eticket') is-invalid @enderror" name="no_eticket"
                id="no_eticket" value="{{ old('no_eticket') }}" required>
            @error('no_eticket')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="no_penerbangan" class="form-label">No Penerbangan</label>
            <input type="text" class="form-control @error('no_penerbangan') is-invalid @enderror"
                name="no_penerbangan" id="no_penerbangan" value="{{ old('no_penerbangan') }}" required>
            @error('no_penerbangan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="total_harga_add" class="form-label">Total Harga</label>
            <div class="input-group @error('total_harga') is-invalid @enderror">
                <div class="input-group-text">Rp.</div>
                <input type="text" class="form-control @error('total_harga') is-invalid @enderror"
                    name="total_harga" id="total_harga_add" value="{{ old('total_harga') }}" required>
            </div>
            @error('total_harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="dokumen" class="form-label">Bukti Tiket</label>
            <input type="file" class="form-control @error('dokumen') is-invalid @enderror" name="dokumen"
                id="dokumen" value="{{ old('dokumen') }}">
            @error('dokumen')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah -->

    @push('script')
        <script src="{{ asset('libs/mask-money/jquery.maskMoney.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('#total_harga').maskMoney({
                    thousands: '.',
                    decimal: ',',
                    allowZero: true,
                    precision: 0
                });
                $('#tambah').on('shown.bs.modal', function() {
                    $('#total_harga_add').maskMoney({
                        thousands: '.',
                        decimal: ',',
                        allowZero: true,
                        precision: 0
                    });
                })
            });
        </script>
    @endpush
</x-app-layout>

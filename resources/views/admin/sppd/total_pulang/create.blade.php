<x-app-layout :$title>
    <div class="row">
        <div class="col-sm-6 col-md">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif (session()->has('failed'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col col-md-12">
            <a class="btn btn-outline-secondary" href="{{ route('sppd.index') }}">
                <i class="fa-regular fa-chevron-left me-2"></i>
                Kembali
            </a>
            <div class="container mt-4">
                <a href="{{ route('surat.index', ['id' => $sppdId, 'jenis' => $jenis]) }}"
                    class="btn btn-outline-secondary">
                    <i class="fa-regular fa-envelopes-bulk me-2"></i>
                    Surat Tugas
                </a>
                <a href="{{ route('uang.index', ['id' => $sppdId, 'jenis' => $jenis]) }}"
                    class="btn btn-outline-secondary">
                    <i class="fa-regular fa-money-bill me-2"></i>
                    Uang Harian
                </a>
                @if ($tipe == 1)
                    <a href="{{ route('akomodasi.index', ['id' => $sppdId, 'jenis' => $jenis]) }}"
                        class="btn btn-outline-secondary">
                        <i class="fa-regular fa-cars me-2"></i>
                        Akomodasi
                    </a>
                    <a href="{{ route('pergi.index', ['id' => $sppdId, 'jenis' => $jenis]) }}"
                        class="btn btn-outline-secondary">
                        <i class="fa-regular fa-plane-departure me-2"></i>
                        Tiket Pergi
                    </a>
                    <a href="{{ route('pulang.index', ['id' => $sppdId, 'jenis' => $jenis]) }}" class="btn btn-primary">
                        <i class="fa-regular fa-plane-arrival me-2"></i>
                        Tiket Pulang
                    </a>
                @endif
            </div>

            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Form Berita --}}
                    <form action="{{ route('pulang.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="sppd_id" value="{{ request('id') }}">
                        <div class="mb-3">
                            <label for="asal" class="form-label">Asal</label>
                            <input type="text" class="form-control @error('asal') is-invalid @enderror"
                                name="asal" id="asal" value="{{ old('asal', $tiket?->asal) }}" autofocus>
                            @error('asal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <input type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                name="tujuan" id="tujuan" value="{{ old('tujuan', $tiket?->tujuan) }}" autofocus>
                            @error('tujuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tgl_penerbangan" class="form-label">Tanggal Penerbangan</label>
                            <input type="date" class="form-control @error('tgl_penerbangan') is-invalid @enderror"
                                name="tgl_penerbangan" id="tgl_penerbangan"
                                value="{{ old('tgl_penerbangan', $tiket?->tgl_penerbangan->format('Y-m-d')) }}">
                            @error('tgl_penerbangan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="maskapai" class="form-label">Maskapai</label>
                            <input type="text" class="form-control @error('maskapai') is-invalid @enderror"
                                name="maskapai" id="maskapai" value="{{ old('maskapai', $tiket?->maskapai) }}">
                            @error('maskapai')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="booking_reference" class="form-label">Booking Reference</label>
                            <input type="text" class="form-control @error('booking_reference') is-invalid @enderror"
                                name="booking_reference" id="booking_reference"
                                value="{{ old('booking_reference', $tiket?->booking_reference) }}">
                            @error('booking_reference')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_eticket" class="form-label">No Eticket</label>
                            <input type="text" class="form-control @error('no_eticket') is-invalid @enderror"
                                name="no_eticket" id="no_eticket" value="{{ old('no_eticket', $tiket?->no_eticket) }}">
                            @error('no_eticket')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="no_penerbangan" class="form-label">No Penerbangan</label>
                            <input type="text" class="form-control @error('no_penerbangan') is-invalid @enderror"
                                name="no_penerbangan" id="no_penerbangan"
                                value="{{ old('no_penerbangan', $tiket?->no_penerbangan) }}">
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
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror"
                                    name="total_harga" id="total_harga"
                                    value="{{ old('total_harga', $tiket?->total_harga) }}">
                            </div>
                            @error('total_harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    {{-- End Form Berita --}}
                </div>
            </div>
        </div>
    </div>

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
            });
        </script>
    @endpush
</x-app-layout>

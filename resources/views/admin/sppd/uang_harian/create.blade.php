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
                <a href="{{ route('uang.index', ['id' => $sppdId, 'jenis' => $jenis]) }}" class="btn btn-primary">
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
                    <a href="{{ route('pulang.index', ['id' => $sppdId, 'jenis' => $jenis]) }}"
                        class="btn btn-outline-secondary">
                        <i class="fa-regular fa-plane-arrival me-2"></i>
                        Tiket Pulang
                    </a>
                @endif
            </div>


            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Form Berita --}}
                    <form action="{{ route('uang.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="sppd_id" value="{{ request('id') }}">
                        <div class="mb-3">
                            <label for="harian" class="form-label">Harian</label>
                            <input type="text" class="form-control @error('harian') is-invalid @enderror"
                                name="harian" id="harian" value="{{ old('harian') }}" autofocus required>
                            @error('harian')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="konsumsi" class="form-label">Konsumsi</label>
                            <input type="number" class="form-control @error('konsumsi') is-invalid @enderror"
                                name="konsumsi" id="konsumsi" value="{{ old('konsumsi') }}" autofocus required>
                            @error('konsumsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="transportasi" class="form-label">Transportasi</label>
                            <input type="text" class="form-control @error('transportasi') is-invalid @enderror"
                                name="transportasi" id="transportasi" value="{{ old('transportasi') }}" autofocus
                                required>
                            @error('transportasi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="representasi" class="form-label">Representasi</label>
                            <input type="number" class="form-control @error('representasi') is-invalid @enderror"
                                name="representasi" id="representasi" value="{{ old('representasi') }}" autofocus
                                required>
                            @error('representasi')
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
            $('#harian, #transportasi').maskMoney({
                thousands: '.',
                decimal: ',',
                allowZero: true,
                precision: 0
            });
        </script>
    @endpush
</x-app-layout>

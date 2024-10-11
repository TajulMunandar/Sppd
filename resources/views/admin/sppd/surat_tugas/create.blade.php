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
            @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                <a href="{{ route('surat.index', ['id' => $sppdId, 'jenis' => $jenis]) }}" class="btn btn-primary">
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
                    <form action="{{ route('surat.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="sppd_id" value="{{ $sppdId }}">

                        <div class="mb-3">
                            <label for="nomor_st" class="form-label">Nomor ST/SPT</label>
                            <input type="text" class="form-control @error('nomor_st') is-invalid @enderror"
                                name="nomor_st" id="nomor_st" value="{{ old('nomor_st') }}" autofocus required>
                            @error('nomor_st')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nomor_spd" class="form-label">Nomor SPD</label>
                            <input type="text" class="form-control @error('nomor_spd') is-invalid @enderror"
                                name="nomor_spd" id="nomor_spd" value="{{ old('nomor_spd') }}" autofocus required>
                            @error('nomor_spd')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="kegiatan" class="form-label">Kegiatan</label>
                            <input type="text" class="form-control @error('kegiatan') is-invalid @enderror"
                                name="kegiatan" id="kegiatan" value="{{ old('kegiatan') }}" required>
                            @error('kegiatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="dari" class="form-label">Dari</label>
                            <input type="text" class="form-control @error('dari') is-invalid @enderror"
                                name="dari" id="dari" value="{{ old('dari') }}" required>
                            @error('dari')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <textarea type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan" id="tujuan"
                                value="{{ old('tujuan') }}" required></textarea>
                            @error('tujuan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="lama_tugas" class="form-label">Lama Tugas</label>
                            <input type="number" class="form-control @error('lama_tugas') is-invalid @enderror"
                                name="lama_tugas" id="lama_tugas" value="{{ old('lama_tugas') }}" required>
                            @error('lama_tugas')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal ST</label>
                            <input type="date" class="form-control @error('tanggal_st') is-invalid @enderror"
                                name="tanggal_st" id="tanggal" value="{{ old('tanggal_st') }}" required>
                            @error('tanggal_st')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                            <input type="date"
                                class="form-control @error('tanggal_berangkat') is-invalid @enderror"
                                name="tanggal_berangkat" id="tanggal_berangkat"
                                value="{{ old('tanggal_berangkat') }}" required>
                            @error('tanggal_berangkat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}"
                                required>
                            @error('tanggal_berangkat')
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
</x-app-layout>

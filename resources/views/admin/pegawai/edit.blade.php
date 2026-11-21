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
        <div class="col col-md-6">
            <a class="btn btn-outline-secondary" href="{{ route('pegawai.index') }}">
                <i class="bi bi-chevron-left me-2"></i>
                Kembali
            </a>

            <div class="card mt-3">
                <div class="card-body">
                    {{-- Form Berita --}}
                    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap dengan Gelar</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="nama" id="name" value="{{ old('name', $pegawai->nama) }}" autofocus
                                required>
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_asn_id" class="form-label">Jenis Asn</label>
                            <select class="form-select" id="jenis_asn_id" name="jenis_asn_id">
                                @foreach ($asns as $asn)
                                    <option value="{{ $asn->id }}">
                                        {{ $asn->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="nip" class="form-label">Nip</label>
                            <input type="text" class="form-control @error('nip') is-invalid @enderror"
                                name="nip" id="nip" value="{{ old('nip', $pegawai->nip) }}"
                                autofocus required>
                            @error('nip')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="golongan_id" class="form-label">Golongan</label>
                            <select class="form-select" id="golongan_id" name="golongan_id">
                                @foreach ($golongans as $golongan)
                                    <option value="{{ $golongan->id }}">
                                        {{ $golongan->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                                name="jabatan" id="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}"
                                autofocus required>
                            @error('jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instansi" class="form-label">Instansi</label>
                            <input type="text" class="form-control @error('instansi') is-invalid @enderror"
                                name="instansi" id="instansi"
                                value="{{ old('instansi', $pegawai->instansi) }}" autofocus required>
                            @error('instansi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update Pegawai</button>
                        </div>
                    </form>
                    {{-- End Form Berita --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

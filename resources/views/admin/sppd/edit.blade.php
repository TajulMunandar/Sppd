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
            <a class="btn btn-outline-secondary" href="{{ route('sppd.index') }}">
                <i class="bi bi-chevron-left me-2"></i>
                Kembali
            </a>

            <div class="mt-3 card">
                <div class="card-body">
                    <form action="{{ route('sppd.update', $sppd->id) }}" method="POST" id="edit">
                        @method('put')
                        @csrf
                        <div class="mb-3">
                            <label for="jenis_tugas_id" class="form-label">Jenis Tugas</label>
                            <select class="form-select @error('jenis_tugas_id') is-invalid @enderror"
                                id="jenis_tugas_id" name="jenis_tugas_id">
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
                                class="form-control @error('nomor_sp2d') is-invalid @enderror"
                                value="{{ old('nomor_sp2d', $sppd->nomor_sp2d) }}" required>
                            @error('nomor_sp2d')
                                <div class="invalid_feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pegawai" class="form-label">Nama Pegawai</label>
                            <select class="form-select select2 @error('pegawai') is-invalid @enderror" id="pegawai"
                                multiple="multiple" name="pegawai[]" style="width: 100%">
                                <option value="">-- pilih pegawai --</option>
                                @foreach ($users as $pegawai)
                                    <option value="{{ $pegawai->id }}"
                                        {{ in_array($pegawai->id, $pegawa) ? 'selected' : '' }}>
                                        {{ $pegawai->nama_lengkap }}
                                    </option>
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
                                class="form-control @error('kegiatan') is-invalid @enderror"
                                value="{{ old('kegiatan', $sppd->kegiatan) }}" required>
                            @error('kegiatan')
                                <div class="invalid_feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="total_biaya" class="form-label">Total Biaya</label>
                            <input type="total_biaya" class="form-control @error('total_biaya') is-invalid @enderror"
                                id="total_biaya" name="total_biaya"
                                value="{{ old('total_biaya', $sppd->total_biaya) }}">
                            @error('total_biaya')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text" id="basic-addon4">Kosongkan jika belum mempunyai total
                            </div>
                        </div>
                        <button class="btn btn-primary float-end">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="{{ asset('libs/mask-money/jquery.maskMoney.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    dropdownParent: $('#edit'),
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

<x-app-layout :$title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ route('surat-tugas.print') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="pegawai"
                                        class="form-label @error('pegawai[]') is-invalid @enderror">Pegawai</label>
                                    <select name="pegawai[]" id="pegawai" class="form-select" multiple>
                                        <option value="">--pilih--</option>
                                        @foreach ($pegawais as $pegawai)
                                            <option value="{{ $pegawai->id }}"
                                                {{ collect(old('pegawai'))->contains($pegawai->id) ? 'selected' : '' }}>
                                                {{ $pegawai->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('pegawai[]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tujuan" class="form-label">Tujuan</label>
                                    <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan') }}"
                                        class="form-control @error('tujuan') is-invalid @enderror">
                                    @error('tujuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="bulan" class="form-label">Bulan</label>
                                    <select name="bulan" id="bulan"
                                        class="form-select @error('bulan') is-invalid @enderror">
                                        <option value="">--pilih--</option>
                                        @foreach (range(1, 12) as $item)
                                            <option value="{{ $item }}" @selected(old('bulan') == $item)>
                                                {{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('bulan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun') }}"
                                        class="form-control @error('tahun') is-invalid @enderror">
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" name="nd" id="nd" value="1"
                                        @checked(old('nd') == 1)
                                        class="form-check-input @error('nd') is-invalid @enderror">
                                    <label for="nd" class="form-check-label">Dinotadinaskan</label>
                                    @error('nd')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Lanjut</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @endpush
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#pegawai').select2({
                    placeholder: '--pilih pegawai--',
                    allowClear: true
                });
            });
        </script>
    @endpush
</x-app-layout>

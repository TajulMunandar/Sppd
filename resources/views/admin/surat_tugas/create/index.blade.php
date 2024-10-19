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
                                    </select>
                                    @error('pegawai[]')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="perihal" class="form-label">Perihal</label>
                                    <input type="text" name="perihal" id="perihal" value="{{ old('perihal') }}"
                                        class="form-control @error('perihal') is-invalid @enderror">
                                    @error('perihal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tujuan" class="form-label">Tujuan</label>
                                    <input type="text" name="tujuan" id="tujuan" value="{{ old('tujuan') }}"
                                        class="form-control @error('tujuan') is-invalid @enderror"
                                        placeholder="Tempat kegiatan">
                                    @error('tujuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="lama_kegiatan" class="form-label">Lama Kegiatan</label>
                                    <div class="input-group">
                                        <input type="number" min="0" step="1" name="lama_kegiatan"
                                            id="lama_kegiatan" value="{{ old('lama_kegiatan') }}"
                                            class="form-control @error('lama_kegiatan') is-invalid @enderror">
                                        <div class="input-group-text">Hari Kerja</div>
                                    </div>
                                    @error('lama_kegiatan')
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
                                <div class="mb-3" id="nomor" style="{{ old('nd') == 1 ? '' : 'display: none' }}">
                                    <label for="nomor_nd" class="form-label">Nomor ND</label>
                                    <input type="text" name="nomor_nd" id="nomor_nd" value="{{ old('nomor_nd') }}"
                                        class="form-control @error('nomor_nd') is-invalid @enderror">
                                    @error('nomor_nd')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3" id="tanggal" style="{{ old('nd') == 1 ? '' : 'display: none' }}">
                                    <label for="tanggal_nd" class="form-label">Tanggal ND</label>
                                    <input type="date" name="tanggal_nd" id="tanggal_nd"
                                        value="{{ old('tanggal_nd') }}"
                                        class="form-control @error('tanggal_nd') is-invalid @enderror">
                                    @error('tanggal_nd')
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
                const nota = $('#nd');
                const token = '{{ $token->token }}'

                $('#pegawai').select2({
                    placeholder: '--pilih pegawai--',
                    allowClear: true,
                    ajax: {
                        url: 'https://simpeg.pupr-acehbaratkab.com/api/data-pegawai', // URL API dari SIMPEG
                        dataType: 'json',
                        delay: 250, // Delay untuk optimasi pencarian
                        headers: {
                            'Authorization': 'Bearer ' + token, // Token yang kamu simpan di SIJADIN
                            'Accept': 'application/json'
                        },
                        data: function(params) {
                            return {
                                q: params.term // Mengirim parameter pencarian dari input pengguna
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data.map(function(pegawai) {
                                    return {
                                        id: pegawai.id,
                                        text: pegawai.nama + ' - ' + pegawai
                                            .nip_baru // Menampilkan nama dan NIP
                                    };
                                })
                            };
                        },
                        cache: true
                    },
                    minimumInputLength: 2
                });

                nota.on('change', () => {
                    if (nota.is(':checked')) {
                        $('#nomor').show();
                        $('#tanggal').show();
                    } else {
                        $('#nomor').hide();
                        $('#tanggal').hide();
                    }
                })
            });
        </script>
    @endpush
</x-app-layout>

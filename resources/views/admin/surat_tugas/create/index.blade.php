<x-app-layout :$title>
    <form action="{{ route('surat-tugas.print') }}" method="POST">
        <div class="gy-3 row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @csrf
                        <div class="mb-3">
                            <label for="jenis" class="form-label">Jenis SPPD</label>
                            <select name="jenis" id="jenis" class="form-select">
                                <option selected>--pilih--</option>
                                <option value="1">Dalam Kota</option>
                                <option value="2">Luar Kota</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pegawai" class="form-label">Pegawai</label>
                            <select name="pegawai[]" id="pegawai" class="form-select" multiple>
                                <option value="">--pilih--</option>
                            </select>
                            @error('pegawai')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <textarea name="perihal" id="perihal" placeholder="Perihal kegiatan"
                                class="form-control @error('perihal') is-invalid @enderror">{{ old('perihal') }}</textarea>
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
                            <div class="row">
                                <div class="col">
                                    <label for="tgl_berangkat" class="form-label">Tanggal Berangkat</label>
                                    <input type="date" name="tgl_berangkat" id="tgl_berangkat"
                                        value="{{ old('tgl_berangkat') }}"
                                        class="form-control @error('tgl_berangkat') is-invalid @enderror"
                                        placeholder="Tempat kegiatan">
                                    @error('tgl_berangkat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="tgl_pulang" class="form-label">Tanggal Pulang</label>
                                    <input type="date" name="tgl_pulang" id="tgl_pulang"
                                        value="{{ old('tgl_pulang') }}"
                                        class="form-control @error('tgl_pulang') is-invalid @enderror"
                                        placeholder="Tempat kegiatan">
                                    @error('tgl_pulang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
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
                            <div class="row">
                                <div class="col">
                                    <label for="tgl_surat" class="form-label">Tanggal Surat</label>
                                    <input type="date" name="tgl_surat" id="tgl_surat"
                                        value="{{ old('tgl_surat') }}"
                                        class="form-control @error('tgl_surat') is-invalid @enderror">
                                    @error('tgl_surat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
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
                                <div class="col">
                                    <label for="tahun" class="form-label">Tahun</label>
                                    <input type="text" name="tahun" id="tahun" value="{{ old('tahun') }}"
                                        class="form-control @error('tahun') is-invalid @enderror">
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="nd" id="nd" value="1"
                                @checked(old('nd') == 1)
                                class="form-check-input @error('nd') is-invalid @enderror">
                            <label for="nd" class="form-check-label">Dinotadinaskan</label>
                            @error('nd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Hidden Input --}}
                        <div class="mb-3" id="pelaksana" style="{{ old('nd') == 1 ? '' : 'display: none' }}">
                            <label for="pelaksana" class="form-label">Pelaksana Nota Dinas</label>
                            <input type="text" name="pelaksana" id="pelaksana" value="{{ old('pelaksana') }}"
                                placeholder="Nama lengkap pegawai"
                                class="form-control @error('pelaksana') is-invalid @enderror">
                            @error('pelaksana')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="nip" style="{{ old('nd') == 1 ? '' : 'display: none' }}">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="text" name="nip" id="nip" value="{{ old('nip') }}"
                                class="form-control @error('nip') is-invalid @enderror">
                            @error('nip')
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
                        <div class="mb-3" id="golongan" style="{{ old('nd') == 1 ? '' : 'display: none' }}">
                            <label for="golongan" class="form-label">Pangkat/Golongan</label>
                            <input type="text" name="golongan" id="golongan" value="{{ old('golongan') }}"
                                class="form-control @error('golongan') is-invalid @enderror">
                            @error('golongan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="jabatan" style="{{ old('nd') == 1 ? '' : 'display: none' }}">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                                class="form-control @error('jabatan') is-invalid @enderror">
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="tanggal" style="{{ old('nd') == 1 ? '' : 'display: none' }}">
                            <label for="tanggal_nd" class="form-label">Tanggal ND</label>
                            <input type="date" name="tanggal_nd" id="tanggal_nd" value="{{ old('tanggal_nd') }}"
                                class="form-control @error('tanggal_nd') is-invalid @enderror">
                            @error('tanggal_nd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="mt-3 btn btn-primary">Lanjut</button>
            </div>
        </div>
    </form>

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
                                        text: pegawai.nama_lengkap + ' - ' + pegawai
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
                        $('#pelaksana').show();
                        $('#nip').show();
                        $('#golongan').show();
                        $('#jabatan').show();
                        $('#nomor').show();
                        $('#tanggal').show();
                    } else {
                        $('#pelaksana').hide();
                        $('#nip').hide();
                        $('#golongan').hide();
                        $('#jabatan').hide();
                        $('#nomor').hide();
                        $('#tanggal').hide();
                    }
                })
            });
        </script>
    @endpush
</x-app-layout>

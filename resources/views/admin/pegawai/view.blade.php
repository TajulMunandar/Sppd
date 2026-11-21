<x-app-layout :$title>
    <div class="row">
        <div class="col col-md-12">
            <a class="btn btn-outline-secondary" href="{{ route('pegawai.index') }}">
                <i class="bi bi-chevron-left me-2"></i>
                Kembali
            </a>

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Nama Pegawai</p>
                                <input class="form-control" disabled value="{{ $pegawai->nama }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Gelar Depan</p>
                                <input class="form-control" disabled value="{{ $pegawai->gelar_depan }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Tempat Lahir</p>
                                <input class="form-control" disabled value="{{ $pegawai->tempat_lahir }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Nip Lama</p>
                                <input class="form-control" disabled value="{{ $pegawai->nip_lama }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Universitas</p>
                                <input class="form-control" disabled value="{{ $pegawai->universitas }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Tingkat Ijazah</p>
                                <input class="form-control" disabled value="{{ $pegawai->tingkat_ijazah }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Golongan</p>
                                <input class="form-control" disabled value="{{ $pegawai->Golongan->name }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Tamat Pangkat Terakhir</p>
                                <input class="form-control" disabled value="{{ $pegawai->tmt_pangkat_terakhir }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Tamat Jabatan</p>
                                <input class="form-control" disabled value="{{ $pegawai->tmt_jabatan }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Masa Kerja Bulan</p>
                                <input class="form-control" disabled value="{{ $pegawai->masa_kerja_bulan }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Instansi Induk</p>
                                <input class="form-control" disabled value="{{ $pegawai->instansi_induk }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">NO Telp</p>
                                <input class="form-control" disabled value="{{ $pegawai->telp }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Rencana Naik Gaji</p>
                                <input class="form-control" disabled value="{{ $pegawai->rencana_naik_gaji }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Jenis Asn</p>
                                <input class="form-control" disabled value="{{ $pegawai->Asn->name }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Gelar Belakang</p>
                                <input class="form-control" disabled value="{{ $pegawai->gelar_belakang }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Tanggal Lahir</p>
                                <input class="form-control" disabled value="{{ $pegawai->tanggal_lahir }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Nip Baru</p>
                                <input class="form-control" disabled value="{{ $pegawai->nip_baru }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Jurusan</p>
                                <input class="form-control" disabled value="{{ $pegawai->jurusan }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Tahun Lulu</p>
                                <input class="form-control" disabled value="{{ $pegawai->tahun_lulus }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Tamat CPNS</p>
                                <input class="form-control" disabled value="{{ $pegawai->tmt_cpns }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Jabatan</p>
                                <input class="form-control" disabled value="{{ $pegawai->jabatan }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Masa Kerja Tahun</p>
                                <input class="form-control" disabled value="{{ $pegawai->masa_kerja_tahun }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Unit Kerja</p>
                                <input class="form-control" disabled value="{{ $pegawai->unit_kerja }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Alamat</p>
                                <input class="form-control" disabled value="{{ $pegawai->alamat }}">
                            </div>
                            <div class="mb-3">
                                <p class="fw-bold mb-0">Rencana Naik Pangkat</p>
                                <input class="form-control" disabled value="{{ $pegawai->rencana_naik_pangkat }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout :$title :$subtitle>
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
                    <ul class="mb-0">
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
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahSppd">Tambah</button>
            <div class="mt-3 card">
                <div class="card-body">
                    {{-- Table --}}
                    <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor ST</th>
                            <th>Nomor SPD</th>
                            <th>Nama Kegiatan</th>
                            <th>Lama Tugas</th>
                            <th>Tanggal ST</th>
                            <th>Tanggal Berangkat</th>
                            <th>Tanggal Kembali</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($surats as $surat)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $surat->nomor_st }}</td>
                                <td>{{ $surat->nomor_spd }}</td>
                                <td>{{ $surat->kegiatan }}</td>
                                <td>{{ $surat->lama_tugas }}</td>
                                <td>{{ Carbon\Carbon::parse($surat->tanggal_st)->format('d/m/Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($surat->tanggal_berangkat)->format('d/m/Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($surat->tanggal_kembali)->format('d/m/Y') }}</td>
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
                            <x-form_modal>
                                @slot('id', "editSppd$loop->iteration")
                                @slot('title', 'Edit Data Surat')
                                @slot('route', route('surat.update', $surat->id))
                                @slot('method')
                                    @method('put')
                                @endslot
                                @slot('btnPrimaryTitle', 'Perbarui')
                                {{-- <div class="mb-3">
                                    <label for="nomor_sp2d" class="form-label">Nomor Sp2d</label>
                                    <input type="number"
                                           class="form-control @error('nomor_sp2d') is-invalid @enderror"
                                           name="nomor_sp2d" id="nomor_sp2d"
                                           value="{{ old('nomor_sp2d', $surat->nomor_sp2d) }}" autofocus required>
                                    @error('nomor_sp2d')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div> --}}

                                <div class="mb-3">
                                    <label for="nomor_st" class="form-label">Nomor ST/SPT</label>
                                    <input type="text"
                                           class="form-control @error('nomor_st') is-invalid @enderror" name="nomor_st"
                                           id="nomor_st" value="{{ old('nomor_st', $surat->nomor_st) }}" autofocus
                                           required>
                                    @error('nomor_st')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nomor_spd" class="form-label">Nomor SPD</label>
                                    <input type="text"
                                           class="form-control @error('nomor_spd') is-invalid @enderror"
                                           name="nomor_spd" id="nomor_spd"
                                           value="{{ old('nomor_spd', $surat->nomor_spd) }}" autofocus required>
                                    @error('nomor_spd')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="kegiatan" class="form-label">Kegiatan</label>
                                    <input type="text"
                                           class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan"
                                           id="kegiatan" value="{{ old('kegiatan', $surat->kegiatan) }}" required>
                                    @error('kegiatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="dari" class="form-label">Dari</label>
                                    <input type="text" class="form-control @error('dari') is-invalid @enderror"
                                           name="dari" id="dari" value="{{ old('dari', $surat->dari) }}"
                                           required>
                                    @error('dari')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tujuan" class="form-label">Tujuan</label>
                                    <textarea type="text" class="form-control @error('tujuan') is-invalid @enderror"
                                              name="tujuan" id="tujuan"
                                              value="{{ old('tujuan', $surat->tujuan) }}" required></textarea>
                                    @error('tujuan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="lama_tugas" class="form-label">Lama Tugas</label>
                                    <input type="number"
                                           class="form-control @error('lama_tugas') is-invalid @enderror"
                                           name="lama_tugas" id="lama_tugas"
                                           value="{{ old('lama_tugas', $surat->lama_tugas) }}" required>
                                    @error('lama_tugas')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal" class="form-label">Tanggal ST</label>
                                    <input type="date"
                                           class="form-control @error('tanggal_st') is-invalid @enderror"
                                           name="tanggal_st"
                                           id="tanggal" value="{{ old('tanggal_st', $surat->tanggal_st) }}" required>
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
                                           value="{{ old('tanggal_berangkat', $surat->tanggal_berangkat) }}"
                                           required>
                                    @error('tanggal_berangkat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                                    <input type="date"
                                           class="form-control @error('tanggal_kembali') is-invalid @enderror"
                                           name="tanggal_kembali" id="tanggal_kembali"
                                           value="{{ old('tanggal_kembali', $surat->tanggal_kembali) }}" required>
                                    @error('tanggal_berangkat')
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
                                @slot('title', 'Hapus Data Surat Tugas')
                                @slot('route', route('surat.destroy', $surat->id))
                                @slot('method')
                                    @method('delete')
                                @endslot
                                @slot('btnPrimaryClass', 'btn-outline-danger')
                                @slot('btnSecondaryClass', 'btn-secondary')
                                @slot('btnPrimaryTitle', 'Hapus')

                                <p class="fs-5">Apakah anda yakin akan menghapus data Surat
                                    <b>{{ $surat->nomor_st }}</b>?
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
    <x-form_modal>
        @slot('id', 'tambahSppd')
        @slot('title', 'Tambah Data Sppd')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('surat.detailStore'))
        @csrf
        <div class="row">
            <input type="hidden" name="sppd_id" value="{{ $sppd->id }}">
            <div class="mb-3">
                <label for="nomor_spd" class="form-label">Nomor Spd</label>
                <input type="text" class="form-control @error('nomor_spd') is-invalid @enderror" name="nomor_spd"
                       id="nomor_spd" value="{{ old('nomor_spd') }}" autofocus required>
                @error('nomor_spd')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nomor_st" class="form-label">Nomor ST/SPT</label>
                <input type="text" class="form-control @error('nomor') is-invalid @enderror" name="nomor_st"
                       id="nomor_st" value="{{ old('nomor') }}" autofocus required>
                @error('nomor_st')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kegiatan" class="form-label">Kegiatan</label>
                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan"
                       id="kegiatan" value="{{ old('kegiatan') }}" required>
                @error('kegiatan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="dari" class="form-label">Dari</label>
                <input type="text" class="form-control @error('dari') is-invalid @enderror" name="dari"
                       id="dari" value="{{ old('dari') }}" required>
                @error('dari')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tujuan" class="form-label">Tujuan</label>
                <textarea type="text" class="form-control @error('tujuan') is-invalid @enderror" name="tujuan"
                          id="tujuan" value="{{ old('tujuan') }}" required></textarea>
                @error('tujuan')
                <div class="invalid-feedback">{{ $message }}</div>
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
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal"
                       id="tanggal" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_berangkat" class="form-label">Tanggal Berangkat</label>
                <input type="date" class="form-control @error('tanggal_berangkat') is-invalid @enderror"
                       name="tanggal_berangkat" id="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" required>
                @error('tanggal_berangkat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                <input type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror"
                       name="tanggal_kembali" id="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                @error('tanggal_berangkat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah surat -->
</x-app-layout>

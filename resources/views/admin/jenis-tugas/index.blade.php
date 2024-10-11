<x-app-layout :$title>
    <div class="row">
        <div class="col-sm-6 col-md">
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

    <button class="mt-2 btn btn-primary fs-5 fw-normal" data-bs-toggle="modal" data-bs-target="#tambahJenis"><i
            class="fa-solid fa-square-plus fs-5 me-2"></i>Tambah
    </button>
    <div class="mt-3 row">
        <div class="col">
            <div class="mt-2 card">
                <div class="card-body">

                    {{-- Tabel Data golongan --}}
                    <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th style="width: 5%">NO</th>
                                <th>NAMA</th>
                                <th style="width: 10%">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jenises as $jenis)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $jenis->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editJenis{{ $loop->iteration }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#hapusJenis{{ $loop->iteration }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>

                                {{-- Modal Edit Jenis --}}
                                <x-form_modal>
                                    @slot('id', "editJenis$loop->iteration")
                                    @slot('title', 'Edit Data Jenis Tugas')
                                    @slot('route', route('jenis.update', $jenis->id))
                                    @slot('method')
                                        @method('put')
                                    @endslot
                                    @slot('btnPrimaryTitle', 'Perbarui')

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <input type="name" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $jenis->name) }}"
                                            autofocus required>
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </x-form_modal>
                                {{-- / Modal Edit jenis --}}

                                {{-- Modal Hapus jenis --}}
                                <x-form_modal>
                                    @slot('id', "hapusJenis$loop->iteration")
                                    @slot('title', 'Hapus Data Jenis Tugas')
                                    @slot('route', route('jenis.destroy', $jenis->id))
                                    @slot('method')
                                        @method('delete')
                                    @endslot
                                    @slot('btnPrimaryClass', 'btn-outline-danger')
                                    @slot('btnSecondaryClass', 'btn-secondary')
                                    @slot('btnPrimaryTitle', 'Hapus')

                                    <p class="fs-5">Apakah anda yakin akan menghapus data Jenis Tugas
                                        <b>{{ $jenis->name }}</b>?
                                    </p>

                                </x-form_modal>
                                {{-- / Modal Hapus jenis  --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{-- / Tabel Data ... --}}
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Tambah jenis -->
    <x-form_modal>
        @slot('id', 'tambahJenis')
        @slot('title', 'Tambah Data Jenis Tugas')
        @slot('overflow', 'overflow-auto')
        @slot('route', route('jenis.store'))

        @csrf
        <div class="row">
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    name="name" autofocus required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </x-form_modal>
    <!-- Akhir Modal Tambah jenis -->
</x-app-layout>

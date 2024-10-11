<x-app-layout :$title>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dokumen-st.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table align-top table-borderless table-sm">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Kode Kegiatan</td>
                                    <td style="width: 2%">:</td>
                                    <td>{{ $sppd->kegiatan }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Pegawai yang Ditugaskan</td>
                                    <td style="width: 2%">:</td>
                                    <td>
                                        <ul class="list-unstyled">
                                            @foreach ($sppd->pegawais as $pegawai)
                                                <li>{{ $pegawai->nama_lengkap }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Dokumen</td>
                                    <td>:</td>
                                    <td>
                                        <input type="hidden" name="sppd" value="{{ $sppd->id }}"
                                            class="form-control" id="sppd" />
                                        <input type="file" name="dokumen" id="dokumen"
                                            class="form-control @error('dokumen') is-invalid @enderror" />
                                        @error('dokumen')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

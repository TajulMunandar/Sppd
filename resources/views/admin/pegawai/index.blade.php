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
        <div class="col">
            <div class="mt-3 card">
                <div class="card-body">
                    <div class="mb-5 row">
                        <div class="col-md-10">
                            <div class="progress" role="progressbar" aria-label="Example with label" aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100">
                                <div id="progress-bar" class="progress-bar" style="width: 0%">0%</div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" id="sync-btn"><i class="fa fa-sync me-2"></i> Sinkron
                                Database</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table align-middle responsive nowrap table-bordered table-striped"
                            style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Nip</th>
                                    <th>Jabatan</th>
                                    <th>Golongan</th>
                                    <th>Jabatan</th>
                                    <th>Instansi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pegawais as $pegawai)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pegawai->nama_lengkap }}</td>
                                        <td>{{ $pegawai->nip_baru }}</td>
                                        <td>{{ $pegawai->jabatan }}</td>
                                        <td>{{ $pegawai->golongan?->nama }}</td>
                                        <td>{{ $pegawai->jabatan }}</td>
                                        <td>{{ $pegawai->unit_kerja }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.progress').hide();
                $('#sync-btn').click(function() {
                    // Menunjukkan progress bar
                    $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0).text('0%');
                    $('.progress').show();

                    $.ajax({
                        url: 'https://arsip.pupr-acehbaratkab.com/api/kepegawaian',
                        method: 'GET',
                        success: function(response) {
                            $.ajax({
                                url: '/api/sync-kepegawaian',
                                method: 'POST',
                                data: JSON.stringify(response.data),
                                contentType: 'application/json',
                                xhr: function() {
                                    var xhr = new XMLHttpRequest();
                                    var xhr = new XMLHttpRequest();
                                    xhr.upload.addEventListener('progress', function(
                                        event) {
                                        if (event.lengthComputable) {
                                            var percentComplete = Math.round((
                                                event.loaded / event
                                                .total) * 100);
                                            $('#progress-bar').css('width',
                                                percentComplete + '%').attr(
                                                'aria-valuenow',
                                                percentComplete).text(
                                                percentComplete + '%');
                                        }
                                    }, false);
                                    return xhr;
                                },
                                success: function(response) {
                                    $('.progress-bar').css('width', '100%').attr(
                                        'aria-valuenow', 100).text(
                                        '100%');
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                },
                                error: function(error) {
                                    $('#progress-bar').css('width', '0%').attr(
                                        'aria-valuenow', 0).text('0%');
                                    $('.progress').hide();
                                    console.log(error);
                                    alert('Sinkronisasi gagal');
                                }
                            });
                        },
                        error: function(error) {
                            $('#progress-bar').css('width', '0%').attr('aria-valuenow', 0).text(
                                '0%');
                            $('.progress').hide();
                            console.log(error);
                            alert('Gagal mendapatkan data dari aplikasi lain');
                        }
                    });
                })
            });
        </script>
    @endpush
</x-app-layout>

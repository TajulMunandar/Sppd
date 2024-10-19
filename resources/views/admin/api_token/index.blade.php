<x-app-layout :$title>
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4>Data Token API</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table datatables" id="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Aplikasi</th>
                                <th>Token</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#table').DataTable({
                    serverSide: true,
                    processing: true,
                    language: {
                        url: "{{ asset('libs/datatables/id.json') }}",
                    },
                    pagingType: 'simple_numbers',
                    ajax: "{{ route('api-token.index') }}",
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, "All"]
                    ],
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'app_name',
                            name: 'app_name'
                        },
                        {
                            data: 'token',
                            name: 'token'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },
                    ],
                });
            });
        </script>
    @endpush
</x-app-layout>

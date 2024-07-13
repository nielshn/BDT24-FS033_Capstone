@section('title', 'Manage Users')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid mb-4">
            @include('layouts.backend.session-message')
            <div
                class="flex justify-between items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-3 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">All Data Users</h2>
            </div>

            <div class="dashboard-content mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-2xl rounded-lg border-0 bg-white bg-opacity-90">
                            <div class="card-body">
                                <div class="table-responsive mt-8">
                                    <table
                                        class="table table-hover scroll-horizontal-vertical w-100 bg-white bg-opacity-90 rounded-lg shadow-lg"
                                        id="crudTable">
                                        <thead class="bg-gradient-to-r from-indigo-200 to-purple-300 text-indigo-900">
                                            <tr>
                                                <th class="py-2">No</th>
                                                <th class="py-2">Name</th>
                                                <th class="py-2">Email</th>
                                                <th class="py-2">Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('addon-script')
        <script>
            // AJAX DataTable
            var datatable = $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{{ route('admin.users.index') }}',
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                        className: 'text-center',
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-left px-4 py-2',
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'text-left px-4 py-2',
                    },
                    {
                        data: 'role',
                        name: 'role',
                        className: 'text-left px-4 py-2',
                        render: function(data, type, row) {
                            return data.split(', ').map(role =>
                                `<span class="inline-block bg-blue-100 text-blue-800 text-sm px-2 py-1 rounded-md">${role}</span>`
                            ).join(' ');
                        },
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('bg-white bg-opacity-90 rounded-md shadow-md mb-2');
                },
            });

            // Custom search functionality
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('admin.users.index') }}',
                    data: $('#search-form').serialize(),
                    success: function(data) {
                        datatable.clear().rows.add(data.data).draw();
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>

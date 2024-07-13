@section('title', 'Category Store')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid mb-4">
            @include('layouts.backend.session-message')
            {{-- <x-slot name="header"> --}}
            <div class="item-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">Manage Categories</h2>
                <p class="text-md">Manage your Category Product</p>
            </div>
            {{-- </x-slot> --}}
            <div class="dashboard-content mt-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-lg rounded-lg border-0">
                            <div class="card-body">
                                <a href="{{ route('admin.categories.create') }}"
                                    class="inline-flex items-center px-3 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-md transition-colors duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>Add New</span>
                                </a>
                                <div class="table-responsive mt-4">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead class="bg-gradient-to-r from-indigo-200 to-purple-300 text-indigo-900">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Icon</th>
                                                <th>Slug</th>
                                                <th>Action</th>
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

    <!-- Modal -->
    {{-- <div class="modal fade" id="categoryDetailModal" tabindex="-1" aria-labelledby="categoryDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryDetailModalLabel">Category Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>No:</strong> <span id="category-id"></span></p>
                    <p><strong>Name:</strong> <span id="category-name"></span></p>
                    <p><strong>Slug:</strong> <span id="category-slug"></span></p>
                    <p><strong>Icon:</strong> <img id="category-icon" src="" style="max-height: 40px;" /></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> --}}

    @push('addon-script')
        <script>
            // AJAX DataTable
            var datatable = $('#crudTable').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                ajax: {
                    url: '{!! url()->current() !!}',
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
                        data: 'icon',
                        name: 'icon',
                        orderable: false,
                        searchable: false,
                        className: 'text-left px-4 py-2',

                    },
                    {
                        data: 'slug',
                        name: 'slug',
                        className: 'text-left px-4 py-2',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '20%',
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).addClass('bg-white bg-opacity-90 rounded-md shadow-md mb-2');
                },
            });

        </script>
    @endpush
</x-app-layout>

@section('title', 'Category Store')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid mb-4">
            @include('layouts.backend.session-message')
            <x-slot name="header">
                <div class="flex justify-between items-center bg-indigo-100 px-4 py-3 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">Manage Categories</h2>
                    <a href="{{ route('admin.categories.create') }}"
                        class="flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Add New</span>
                    </a>
                </div>
            </x-slot>
            <div class="dashboard-content">
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
                                        <thead>
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
    <div class="modal fade" id="categoryDetailModal" tabindex="-1" aria-labelledby="categoryDetailModalLabel"
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
    </div>

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
                        searchable: false
                    },
                    {
                        data: 'name',

                        name: 'name'
                    },
                    {
                        data: 'icon',
                        name: 'icon',
                        orderable: false,
                        searchable: false,

                    },
                    {
                        data: 'slug',
                        name: 'slug'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '%',
                    },
                ]
            });

            // Function to show category details in modal
            function showCategoryDetails(id, name, slug, icon) {
                $('#category-id').text(id);
                $('#category-name').text(name);
                $('#category-slug').text(slug);
                $('#category-icon').attr('src', icon ? '/storage/' + icon : '');
                $('#categoryDetailModal').modal('show');
            }

            // Event delegation for dynamically created elements
            $(document).on('click', '.view-category-btn', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var slug = $(this).data('slug');
                var icon = $(this).data('icon');
                showCategoryDetails(id, name, slug, icon);
            });
        </script>
    @endpush
</x-app-layout>

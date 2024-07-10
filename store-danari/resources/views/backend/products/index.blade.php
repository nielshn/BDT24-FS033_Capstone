@section('title', 'All Products')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">All Products</h2>
                    <p class="text-0xl">Manage it well and get money</p>
                </div>
            </x-slot>

            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Search form -->
                                <div class="flex justify-end mb-8">
                                    <form id="search-form" method="GET" class="flex items-center">
                                        <input type="text" name="search" placeholder="Search products"
                                            class="border border-gray-300 rounded-l-md px-4 py-2 focus:outline-none focus:ring focus:border-blue-300 text-sm">
                                        <button type="submit"
                                            class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600 transition-colors duration-300 text-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M15.293 12.707a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 111.414 1.414L13.414 9H18a1 1 0 010 2h-4.586l1.879 1.879a1 1 0 11-1.414 1.414zM10 18a8 8 0 100-16 8 8 0 000 16z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                <div class="table-responsive" id="prod+ucts-table">
                                    @include('backend.products.partials._products-table')
                                </div>

                                <!-- Pagination -->
                                <div class="mt-4 flex justify-center">
                                    {{ $products->appends(['search' => request('search')])->links('pagination::tailwind') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Detail Modal -->
            <div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog"
                aria-labelledby="productDetailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="three-dimension-container">
                                        <img id="productDetailImage" src="" alt="Product Image"
                                            class="img-fluid three-dimension">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 id="productDetailName"></h5>
                                    <p id="productDetailDescription"></p>
                                    <p><strong>Price:</strong> $<span id="productDetailPrice"></span></p>
                                    <p><strong>Stock:</strong> <span id="productDetailStock"></span></p>
                                    <div id="productDetailCategory"></div>
                                    <div id="productDetailPhotos" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('addon-script')
        <script>
            function showProductDetailModal(product) {
                document.getElementById('productDetailName').textContent = product.name;
                document.getElementById('productDetailDescription').textContent = product.description;
                document.getElementById('productDetailPrice').textContent = product.price;
                document.getElementById('productDetailStock').textContent = product.stock;
                document.getElementById('productDetailCategory').textContent = 'Category: ' + product.category.name;

                const photoContainer = document.getElementById('productDetailPhotos');
                photoContainer.innerHTML = '';
                product.photos.forEach(photo => {
                    const img = document.createElement('img');
                    img.src = photo.url;
                    img.classList.add('img-fluid', 'thumbnail');
                    photoContainer.appendChild(img);
                });

                $('#productDetailModal').modal('show');
            }

            document.querySelectorAll('.view-product-detail').forEach(button => {
                button.addEventListener('click', function() {
                    const productId = this.getAttribute('data-id');
                    fetch(`{{ route('admin.products.show', '') }}/${productId}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            showProductDetailModal(data);
                        });
                });
            });

            document.getElementById('search-form').addEventListener('submit', function(e) {
                e.preventDefault();
                const searchQuery = e.target.search.value;

                fetch(`{{ route('admin.allproducts.index') }}?search=${searchQuery}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('products-table').innerHTML = data.html;
                        attachViewDetailEvents();
                    });
            });

            function attachViewDetailEvents() {
                document.querySelectorAll('.view-product-detail').forEach(button => {
                    button.addEventListener('click', function() {
                        const productId = this.getAttribute('data-id');
                        fetch(`{{ route('admin.products.show', '') }}/${productId}`, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                showProductDetailModal(data);
                            });
                    });
                });
            }

            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover this product!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Initial attachment of view detail events
            attachViewDetailEvents();
        </script>
    @endpush
</x-app-layout>

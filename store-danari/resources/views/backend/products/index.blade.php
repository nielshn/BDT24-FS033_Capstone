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
                                    <form action="{{ route('admin.allproducts.index') }}" method="GET"
                                        class="flex items-center">
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

                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead class="bg-gray-200">
                                            <tr>
                                                <th class="px-4 py-2 text-left">No</th>
                                                <th class="px-4 py-2 text-left">Name</th>
                                                <th class="px-4 py-2 text-left">Seller</th>
                                                <th class="px-4 py-2 text-left">Category</th>
                                                <th class="px-4 py-2 text-left">Price</th>
                                                <th class="px-4 py-2 text-left">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($products as $index => $product)
                                                <tr class="border-b">
                                                    <td class="px-4 py-2">
                                                        {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                                                    </td>
                                                    <td class="px-4 py-2">{{ $product->name }}</td>
                                                    <td class="px-4 py-2">{{ $product->user->name }}</td>
                                                    <td class="px-4 py-2">{{ $product->category->name }}</td>
                                                    <td class="px-4 py-2">${{ number_format($product->price, 2) }}</td>
                                                    <td class="px-4 py-2">
                                                        <div class="ml-auto flex space-x-3">
                                                            {{-- <a href="{{ route('admin.products.edit', $product) }}"
                                                                class="px-4 py-2 bg-yellow-400 text-white rounded-md flex items-center justify-center">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        d="M15.232 5.232a3 3 0 011.768.768l2.83 2.83a3 3 0 010 4.243l-7.182 7.182a4 4 0 01-1.414.707L9 21l-.293-1.414a4 4 0 01.707-1.414l7.182-7.182a3 3 0 010-4.243l2.83-2.83a3 3 0 01.768-1.768zM12.707 8.707l1.586-1.586m-7.418 9.192l.293 1.414a4 4 0 001.414-.707l7.182-7.182a3 3 0 00-4.243-4.243l-7.182 7.182a4 4 0 00-.707 1.414l1.414.293z" />
                                                                </svg>
                                                                <span class="ml-2">Edit</span>
                                                            </a> --}}

                                                            <!-- View Product Details Modal -->
                                                            <a href="#"
                                                                onclick="showProductDetailModal('{{ $product->name }}', '{{ $product->description }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ $product->productGaleries->isNotEmpty() ? Storage::url($product->productGaleries->first()->photos) : asset('images/default-product-image.png') }}')"
                                                                class="px-4 py-2 bg-green-400 text-white rounded-md flex items-center justify-center">
                                                                <!-- Icon mata SVG berwarna hijau -->
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                                    fill="none" viewBox="0 0 24 24"
                                                                    stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2" d="M12 14l9-5-9-5-9 5z" />
                                                                </svg>
                                                            </a>

                                                            {{-- <form
                                                                action="{{ route('admin.products.destroy', $product) }}"
                                                                method="POST" class="delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" id="delete-btn"
                                                                    class="px-4 py-2 bg-red-700 text-white rounded-md flex items-center justify-center">
                                                                    <svg width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M21.0697 5.23C19.4597 5.07 17.8497 4.95 16.2297 4.86V4.85L16.0097 3.55C15.8597 2.63 15.6397 1.25 13.2997 1.25H10.6797C8.34967 1.25 8.12967 2.57 7.96967 3.54L7.75967 4.82C6.82967 4.88 5.89967 4.94 4.96967 5.03L2.92967 5.23C2.50967 5.27 2.18967 5.65 2.22967 6.07C2.26967 6.49 2.64967 6.81 3.06967 6.77L5.10967 6.57C5.78967 13.79 6.54967 21.03 6.57967 21.27C6.62967 21.79 6.95967 22.25 8.14967 22.25H15.8597C17.0497 22.25 17.3897 21.81 17.4297 21.28C17.4497 21.05 18.1997 13.79 18.8897 6.57L20.9297 6.77C21.3497 6.81 21.7297 6.49 21.7697 6.07C21.8097 5.65 21.4897 5.27 21.0697 5.23ZM9.32967 3.64C9.34967 3.52 9.37967 3.38 9.43967 3.22C9.61967 2.66 9.85967 2.52 10.6797 2.52H13.2997C14.1197 2.52 14.3597 2.66 14.5397 3.23C14.5997 3.39 14.6297 3.52 14.6497 3.64L14.8597 4.86H9.11967L9.32967 3.64ZM16.8397 20.51C16.8097 20.81 16.7297 21.03 15.8497 21.03H8.14967C7.26967 21.03 7.17967 20.81 7.14967 20.52C7.11967 20.28 6.37967 13.04 5.67967 5.84C8.30967 5.64 11.0097 5.64 13.6797 5.64C16.3497 5.64 19.0597 5.65 21.6797 5.84C20.9797 13.04 20.2397 20.28 20.2097 20.52H20.2097Z"
                                                                            fill="white" />
                                                                        <path
                                                                            d="M14.4393 9.42969C14.0193 9.42969 13.6793 9.76969 13.6793 10.1897V18.5997C13.6793 19.0197 14.0193 19.3597 14.4393 19.3597C14.8593 19.3597 15.1993 19.0197 15.1993 18.5997V10.1897C15.1993 9.76969 14.8593 9.42969 14.4393 9.42969Z"
                                                                            fill="white" />
                                                                        <path
                                                                            d="M9.56007 9.42969C9.14007 9.42969 8.80007 9.76969 8.80007 10.1897V18.5997C8.80007 19.0197 9.14007 19.3597 9.56007 19.3597C9.98007 19.3597 10.3201 19.0197 10.3201 18.5997V10.1897C10.3201 9.76969 9.98007 9.42969 9.56007 9.42969Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                    <span class="ml-2">Delete</span>
                                                                </button>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center px-4 py-2">
                                                        No products found.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination -->
                                <div class="mt-4 flex justify-center">
                                    {{ $products->links('pagination::tailwind') }}
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
                                    <img id="productDetailImage" src="" alt="Product Image"
                                        class="img-fluid">
                                </div>
                                <div class="col-md-6">
                                    <h5 id="productDetailName"></h5>
                                    <p id="productDetailDescription"></p>
                                    <p><strong>Price:</strong> $<span id="productDetailPrice"></span></p>
                                    <p><strong>Stock:</strong> <span id="productDetailStock"></span></p>
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
            function showProductDetailModal(name, description, price, stock, image) {
                document.getElementById('productDetailName').textContent = name;
                document.getElementById('productDetailDescription').textContent = description;
                document.getElementById('productDetailPrice').textContent = price;
                document.getElementById('productDetailStock').textContent = stock;
                document.getElementById('productDetailImage').src = image;

                $('#productDetailModal').modal('show');
            }

            // SweetAlert for delete confirmation
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
        </script>
    @endpush
</x-app-layout>

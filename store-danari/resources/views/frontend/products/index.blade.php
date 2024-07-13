@section('title', 'Products Store')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">My Products</h2>
                <p class="text-md">Manage it well and get money</p>
            </div>
            @include('layouts.backend.session-message')
            <div class="dashboard-content mt-4">
                <div class="row">
                    <div class="col-12 flex justify-between items-center mb-4">
                        <a href="{{ route('products.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-md transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span>Add New</span>
                        </a>
                        <!-- Search form -->
                        <form id="search-form" method="GET" class="flex items-center">
                            <input type="text" name="search" id="search" placeholder="Search products"
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
                </div>
                <div id="products-list">
                    @include('frontend.products.partials.products-list', ['products' => $products])
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search-form').addEventListener('submit', function(event) {
            event.preventDefault();
            fetchProducts();
        });

        document.getElementById('search').addEventListener('input', function() {
            fetchProducts();
        });

        function fetchProducts() {
            let search = document.getElementById('search').value;
            let url = '{{ route('products.index') }}' + '?search=' + search;

            fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('products-list').innerHTML = html;
                })
                .catch(error => {
                    console.error('Error fetching products:', error);
                });
        }
    </script>
</x-app-layout>

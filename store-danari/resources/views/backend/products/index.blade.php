@section('title', 'All Products')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            {{-- <x-slot name="header"> --}}
                <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold  text-indigo-900 leading-tight mb-2">All Products</h2>
                    <p class="text-md">Manage it well and get money</p>
                </div>
            {{-- </x-slot> --}}

            <div class="dashboard-content mt-4">
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

                                <div class="table-responsive" id="products-table">
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
        </div>
    </div>
    @include('backend.products.partials._script')
</x-app-layout>

<table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
    <thead class="bg-gradient-to-r from-indigo-200 to-purple-300 text-indigo-900">
        <tr>
            <th>No</th>
            <th>Name</th>
            {{-- <th>Price</th> --}}
            {{-- <th>Category</th> --}}
            <th>Seller</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $index => $product)
            <tr>
                <td> {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                </td>
                <td>{{ $product->name }}</td>
                {{-- <td>{{ number_format($product->price, 2) }}</td> --}}
                {{-- <td>{{ $product->category->name }}</td> --}}
                <td>{{ $product->user->name }}</td>
                <td>
                    <a href="{{ route('admin.allproducts.show', $product) }}"
                        class="px-4 py-2 bg-green-400 text-white rounded-md flex items-center justify-center">
                        <!-- Icon mata SVG berwarna hijau -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5z" />
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

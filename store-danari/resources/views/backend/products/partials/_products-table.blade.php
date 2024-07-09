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
                <td class="px-4 py-2">$ {{ number_format($product->price, 2) }}</td>
                <td class="px-4 py-2">
                    <div class="ml-auto flex space-x-3">
                        <!-- View Product Details Modal -->
                        <a href="#"
                            onclick="showProductDetailModal('{{ $product->name }}', '{{ $product->description }}', '{{ $product->price }}', '{{ $product->stock }}', '{{ $product->category->name }}', @json($product->productGaleries->map(fn($gallery) => Storage::url($gallery->photos))) )"
                            class="px-4 py-2 bg-green-400 text-white rounded-md flex items-center justify-center">
                            <!-- Icon for viewing product details -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 14l9-5-9-5-9 5z" />
                            </svg>
                        </a>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center px-4 py-2">No products found.</td>
            </tr>
        @endforelse
    </tbody>
</table>

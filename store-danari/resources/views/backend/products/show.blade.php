@section('title', 'Product Details')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="items-center bg-gradient-to-r from-indigo-200 to-purple-300 px-4 py-2 rounded-md shadow-md">
                <h2 class="text-2xl font-semibold text-indigo-900 leading-tight mb-2">Product Details</h2>
                <p class="text-md">Explore the details of your selected product</p>
            </div>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden mt-4">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-1/2 mt-4 ml-4">
                        <div id="product-carousel" class="carousel slide relative mb-4" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($product->productGaleries as $index => $gallery)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ Storage::url($gallery->photos) }}"
                                            class="d-block w-full object-cover" alt="Product Image"
                                            onclick="zoomImage(this)">
                                    </div>
                                @endforeach
                            </div>
                            <a class="carousel-control-prev absolute top-1/2 left-0 transform -translate-y-1/2"
                                href="#product-carousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon bg-black rounded-full"
                                    aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next absolute top-1/2 right-0 transform -translate-y-1/2"
                                href="#product-carousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon bg-black rounded-full"
                                    aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                        <div class="flex justify-between mt-4 mb-6 space-x-4">
                            <div class="w-1/3 p-2 bg-indigo-100 text-center rounded-md shadow-md">
                                <span class="text-lg text-indigo-900 font-semibold">Category</span>
                                <p class="text-base mt-1">{{ $product->category->name }}</p>
                            </div>
                            <div class="w-1/3 p-2 bg-green-100 text-center rounded-md shadow-md">
                                <span class="text-lg text-green-900 font-semibold">Price</span>
                                <p class="text-base mt-1">${{ number_format($product->priceca) }}</p>
                            </div>
                            <div class="w-1/3 p-2 bg-yellow-100 text-center rounded-md shadow-md">
                                <span class="text-lg text-yellow-900 font-semibold">Stock</span>
                                <p class="text-base mt-1">{{ $product->stock }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="lg:w-1/2 p-8">
                        <h2 class="text-3xl font-bold mb-4">{{ $product->name }}</h2>
                        <p class="text-gray-700 text-base mb-6">{!! $product->description !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Zoom Image Modal -->
    <div class="modal fade" id="zoomModal" tabindex="-1" role="dialog" aria-labelledby="zoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img id="zoomedImage" src="" class="img-fluid w-full" alt="Zoomed Image">
                </div>
                <div class="modal-footer justify-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('addon-script')
        <script>
            function zoomImage(img) {
                document.getElementById('zoomedImage').src = img.src;
                $('#zoomModal').modal('show');
            }

            $(document).ready(function() {
                $('.carousel').carousel();
            });
        </script>
    @endpush --}}
</x-app-layout>

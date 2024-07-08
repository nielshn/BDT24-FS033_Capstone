@section('title', 'Create Product')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <x-slot name="header">
                    <div class="flex justify-between items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                        <h4 class="text-2xl font-semibold text-indigo-900 leading-tight">Create Categories</h4>
                        <a href="{{ route('products.index') }}"
                            class="flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md transition-colors duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <span>Back</span>
                        </a>
                    </div>
                </x-slot>
                <div class="dashboard-content">
                    <div class="row">
                        <div class="col-12">
                            @if ($errors->any())
                                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                    role="alert">
                                    <strong class="font-bold">Terjadi kesalahan!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="block">{{ $error }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product-name">Product Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        id="product-name" aria-describedby="product-name"
                                                        placeholder="Product Name" value="{{ old('name') }}" />
                                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price">Price</label>
                                                    <input type="number" name="price" class="form-control"
                                                        id="price" aria-describedby="price" placeholder="Price"
                                                        value="{{ old('price') }}" />
                                                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category">Category</label>
                                                    <select name="category_id" id="category" class="form-control">
                                                        <option value="" disabled>Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="stock">Stock</label>
                                                    <input type="number" name="stock" class="form-control"
                                                        id="stock" aria-describedby="stock" placeholder="Stock"
                                                        value="{{ old('stock') }}" />
                                                    <x-input-error :messages="$errors->get('stock')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="photos">Thumbnails</label>
                                                    <input type="file" name="photos[]" class="form-control"
                                                        id="photos" multiple />
                                                    <p class="text-muted">You can choose more than one!</p>
                                                    <x-input-error :messages="$errors->get('photos.*')" class="mt-2" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-right">
                                                <button type="submit" class="btn btn-success px-5">
                                                    Save Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @push('addon-script')
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
        <script>
            ClassicEditor.create(document.querySelector('#description'))
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    @endpush
</x-app-layout>

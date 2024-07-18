@section('title', 'Store Settings')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">Store Settings</h2>
                    <p class="text-1xl font"> Make store that profitable</p>
                </div>
            </x-slot>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <form method="POST" action="{{ route('store-settings.update', $store->id) }} "
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="store-name">Store Name</label>
                                                <input type="text" name="store_name" class="form-control"
                                                    id="store-name" value="{{ old('store_name', $store->name) }}"
                                                    aria-describedby="store-name" placeholder="Store Name" />
                                                <x-input-error :messages="$errors->get('store_name')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="categories_id" id="category" class="form-control">
                                                    <option value="{{ $store->categories_id }}" disabled>Select Category
                                                    </option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $store->categories_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('categories_id')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="store-status">Store Status</label>
                                                <p class="text-muted">
                                                    Apakah saat ini toko Anda buka?
                                                </p>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                        name="is_store_open" id="openStoreTrue" value="1"
                                                        {{ $store->status == 1 ? 'checked' : '' }} />
                                                    <label for="openStoreTrue" class="custom-control-label">Buka</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                        name="is_store_open" id="openStoreFalse" value="0"
                                                        {{ $store->status == 0 ? 'checked' : '' }} />
                                                    <label for="openStoreFalse" class="custom-control-label">Sementara
                                                        Tutup</label>
                                                </div>
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
</x-app-layout>

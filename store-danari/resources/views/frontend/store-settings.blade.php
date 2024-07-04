@section('title', 'Store Settings')
<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <x-slot name="header">
                <div class="items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">Create Categories</h2>
                    <p class="text-1xl font">Update your current profile</p>
                </div>
            </x-slot>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-12">
                        <form action="">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="store-name">Store Name</label>
                                                <input type="text" class="form-control" id="store-name"
                                                    aria-describedby="store-name" placeholder="Store Name" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <select name="category" id="category" class="form-control">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" disabled>
                                                            {{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col md-6">
                                            <div class="from-group">
                                                <label for="store">Store Status</label>
                                                <p class="text-muted">
                                                    Apakah saat ini toko Anda buka?
                                                </p>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                        name="is_store_open" id="openStoreTrue"
                                                        :value="true" />
                                                    <label for="openStoreTrue" class="custom-control-label">Buka</label>
                                                </div>
                                                <div class="custom-control custom-radio custom-control-inline">
                                                    <input type="radio" class="custom-control-input"
                                                        name="is_store_open" id="openStoreFalse"
                                                        :value="true" />
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

@section('title', 'Create Category')

<x-app-layout>
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid mb-4">
            <x-slot name="header">
                <div class="flex justify-between items-center bg-indigo-100 px-6 py-4 rounded-md shadow-md">
                    <h2 class="text-2xl font-semibold text-indigo-900 leading-tight">Create Categories</h2>
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-md transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Back</span>
                    </a>
                </div>
            </x-slot>
            {{-- <div class="dashboard-heading">
                <h2 class="dashboard-title">Category</h2>
                <p class="dashboard-subtitle">Create Category</p>
            </div> --}}
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        {{-- <div class="flex justify-end mb-4">
                            <a href="{{ route('admin.categories.index') }}"
                                class="font-bold py-2 px-4 bg-gray-200 text-gray-800 rounded-full flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                <span>Back</span>
                            </a>
                        </div> --}}
                        @if ($errors->any())
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                <strong class="font-bold">Terjadi kesalahan!</strong>
                                @foreach ($errors->all() as $error)
                                    <span class="block">{{ $error }}</span>
                                @endforeach
                            </div>
                        @endif
                        <div class="card shadow-lg rounded-lg border-0">
                            <div class="card-body p-5">
                                <form method="POST" action="{{ route('admin.categories.store') }}"
                                    enctype="multipart/form-data" class="mt-8">
                                    @csrf
                                    @method('PUT')

                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-input-label for="name" :value="__('Name')" />
                                                <x-text-input id="name" class="block mt-1 w-full" type="text"
                                                    name="name" autocomplete required autofocus />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <x-input-label for="icon" :value="__('Icon')" />
                                                <x-text-input id="icon" class="block mt-1 w-full" type="file"
                                                    name="icon" autofocus autocomplete />
                                                <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end">
                                        <button type="submit"
                                            class="font-bold py-3 px-5 bg-indigo-700 text-white rounded-full hover:bg-indigo-800 focus:outline-none focus:bg-indigo-800">
                                            Create Category
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

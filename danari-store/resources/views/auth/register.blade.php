<x-guest-layout>
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center justify-content-center row-login">
                    <div class="col-lg-4">
                        <h2>Memulai untuk jual beli<br />dengan cara terbaru</h2>
                        <form method="POST" action="{{ route('register') }}" class="mt-3">
                            @csrf

                            <!-- Full Name -->
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" v-model="name"
                                    required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div class="form-group mt-4">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" v-model="email"
                                    required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="form-group mt-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required
                                    autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mt-4">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <!-- Store Option -->
                            <div class="form-group mt-4">
                                <label for="store">Store</label>
                                <p class="text-muted">Apakah anda ingin membuka toko?</p>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreTrue" v-model="is_store_open" value="true" />
                                    <label for="openStoreTrue" class="custom-control-label">Iya, boleh</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" class="custom-control-input" name="is_store_open"
                                        id="openStoreFalse" v-model="is_store_open" value="false" />
                                    <label for="openStoreFalse" class="custom-control-label">Enggak, makasih</label>
                                </div>
                            </div>

                            <!-- Store Name (Conditional) -->
                            <div class="form-group mt-4" v-if="is_store_open === 'true'">
                                <label for="tokoName">Nama Toko</label>
                                <input type="text" name="tokoName" id="tokoName" class="form-control"
                                    v-model="store_name" />
                            </div>

                            <!-- Category (Conditional) -->
                            <div class="form-group mt-4" v-if="is_store_open === 'true'">
                                <label for="category">Kategori</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="" disabled>Select Category</option>
                                    <!-- Populate options here -->
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="btn btn-success btn-block mt-4">{{ __('Register') }}</button>
                            </div>

                            <!-- Back to Sign In -->
                            <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">Back to Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script src="https://unpkg.com/vue-toasted"></script>
        <script>
            Vue.use(Toasted);

            var register = new Vue({
                el: "#register",
                mounted() {
                    AOS.init();
                    @if ($errors->any())
                        this.$toasted.error(
                            "{{ $errors->first() }}", {
                                position: "top-center",
                                className: "rounded",
                                duration: 5000,
                                icon: "error",
                            }
                        );
                    @endif
                },
                data: {
                    name: "{{ old('name') }}",
                    email: "{{ old('email') }}",
                    password: "",
                    is_store_open: "{{ old('is_store_open', 'false') }}",
                    store_name: "{{ old('store_name') }}",
                },
            });
        </script>
    @endpush
</x-guest-layout>

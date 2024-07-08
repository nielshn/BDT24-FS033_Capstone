<x-guest-layout>
    <div class="page-content page-auth" id="register">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center justify-content-center row-login">
                    <div class="col-lg-4">
                        <h2>Memulai untuk jual beli<br />dengan cara terbaru</h2>
                        <form method="POST" action="{{ route('register') }}" class="mt-3" enctype="multipart/form-data">
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
                                    @change="checkForEmailAvailability()"
                                    :class="{ 'is-invalid': this.email_unavailable }" value="{{ old('email') }}"
                                    required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Avatar -->
                            <div class="form-group mt-4">
                                <label for="avatar">Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control" required
                                    autocomplete="avatar" />
                                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
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
                                <label for="store_name">Nama Toko</label>
                                <input type="text" name="store_name" id="store_name" class="form-control"
                                    v-model="store_name" />
                            </div>

                            <!-- Category (Conditional) -->
                            <div class="form-group mt-4" v-if="is_store_open === 'true'">
                                <label for="category">Kategori</label>
                                <select name="categories_id" class="form-control" id="category">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit" class="btn btn-success btn-block mt-4"
                                    :disabled="this.email_unavailable">{{ __('Register') }}</button>
                            </div>

                            <!-- Back to Sign In -->
                            <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">Back to Sign In</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('addon-style')
        <style>
            .custom-toast {
                background: #f8f9fa;
                color: #343a40;
                border-radius: 8px;
                padding: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease-in-out;
            }

            .custom-toast.error {
                border-left: 4px solid #dc3545;
            }

            .custom-toast.success {
                border-left: 4px solid #28a745;
            }

            .custom-toast p {
                margin: 0;
                font-weight: 500;
            }

            .form-control {
                border-radius: 8px;
                padding: 12px 15px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease-in-out;
            }

            .form-control:focus {
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }

            .btn {
                border-radius: 8px;
                padding: 12px 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease-in-out;
            }

            .btn:hover {
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            }

            .btn-signup {
                background-color: #6c757d;
                color: white;
            }

            .btn-signup:hover {
                background-color: #5a6268;
            }

            .btn-success {
                background-color: #28a745;
                color: white;
            }

            .btn-success:hover {
                background-color: #218838;
            }
        </style>
    @endpush

    @push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
        <script src="https://unpkg.com/vue-toasted"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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
                                className: "custom-toast error",
                                duration: 6000,
                                icon: "error",
                            }
                        );
                    @endif
                },
                methods: {
                    checkForEmailAvailability: function() {
                        var self = this;
                        axios.get('{{ route('api-register-check') }}', {
                                params: {
                                    email: this.email
                                }
                            })
                            .then(function(response) {
                                if (response.data == 'Available') {
                                    self.$toasted.show(
                                        "Email anda tersedia! Silahkan lanjut langkah selanjutnya!", {
                                            position: "top-center",
                                            className: "custom-toast success",
                                            duration: 4000,
                                        }
                                    );
                                    self.email_unavailable = false;
                                } else {
                                    self.$toasted.error(
                                        "Maaf, tampaknya email sudah terdaftar pada sistem kami.", {
                                            position: "top-center",
                                            className: "custom-toast error",
                                            duration: 4000,
                                        }
                                    );
                                    self.email_unavailable = true;
                                }
                                console.log(response.data);
                            })
                    }
                },
                data: {
                    name: "{{ old('name') }}",
                    email: "{{ old('email') }}",
                    is_store_open: "{{ old('is_store_open', 'false') }}",
                    store_name: "{{ old('store_name') }}",
                    email_unavailable: false,
                },
            });
        </script>
    @endpush
</x-guest-layout>

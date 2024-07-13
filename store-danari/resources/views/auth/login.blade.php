<x-guest-layout>
    <div class="page-content page-auth">
        <div class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-6 text-center">
                        <img src="{{ asset('images/login-placeholder.png') }}" alt="login placeholder"
                            class="w-50 mb-4 mb-lg-none" />
                    </div>
                    <div class="col-lg-5">
                        <h2>Belanja kebutuhan utama, menjadi lebih mudah</h2>
                        <form method="POST" action="{{ route('login') }}" class="mt-3">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control w-75"
                                    value="{{ old('email') }}" required autofocus autocomplete="username" />
                                @error('email')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mt-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control w-75" required
                                    autocomplete="current-password" />
                                @error('password')
                                    <div class="text-red-500 mt-2 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="remember-forgot mt-4">
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox"
                                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                                        name="remember">
                                    <span
                                        class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100"
                                        href="{{ route('password.request') }}">
                                        {{ __('Forgot password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="flex items-center justify-end mt-4">
                                <button type="submit"
                                    class="btn btn-success btn-block w-75 mt-4">{{ __('Log in') }}</button>
                            </div>
                            <a href="/register" class="btn btn-signup btn-block w-75 mt-2">Sign Up</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>

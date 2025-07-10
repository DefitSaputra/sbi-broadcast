<x-guest-layout>
    <div class="min-h-screen bg-white flex">
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    {{-- Logo Aplikasi --}}
                    <a href="/">
                        <img class="h-12 w-auto" src="{{ asset('images/logo-sbi.png') }}" alt="Application Logo">
                    </a>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Masuk ke Akun Anda
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Atau
                        <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-500">
                            buat akun baru
                        </a>
                    </p>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form method="POST" action="{{ route('login') }}" class="space-y-6">
                            @csrf

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" value="Alamat Email" />
                                <div class="mt-1">
                                    <x-text-input id="email" name="email" type="email" :value="old('email')" required autofocus class="w-full" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="space-y-1">
                                <x-input-label for="password" value="Password" />
                                <div class="mt-1">
                                    <x-text-input id="password" name="password" type="password" required autocomplete="current-password" class="w-full" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <!-- Remember Me -->
                                <div class="flex items-center">
                                    <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                    <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                        Ingat saya
                                    </label>
                                </div>

                                @if (Route::has('password.request'))
                                    <div class="text-sm">
                                        <a href="{{ route('password.request') }}" class="font-medium text-red-600 hover:text-red-500">
                                            Lupa password?
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div>
                                {{-- Tombol Login Utama --}}
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Masuk
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Sisi Gambar --}}
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/bg-sbi6.jpg') }}" alt="Latar belakang login">
        </div>
    </div>
</x-guest-layout>

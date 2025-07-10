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
                        Buat Akun Baru
                    </h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-medium text-red-600 hover:text-red-500">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <form method="POST" action="{{ route('register') }}" class="space-y-6">
                            @csrf

                            <!-- Name -->
                            <div>
                                <x-input-label for="name" value="Nama Lengkap" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email Address -->
                            <div>
                                <x-input-label for="email" value="Alamat Email" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div>
                                <x-input-label for="password" value="Password" />
                                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                            </div>

                            <div>
                                {{-- Tombol Register Utama --}}
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    Daftar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Sisi Gambar --}}
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('images/bg-sbi3.jpeg') }}" alt="Latar belakang register">
        </div>
    </div>
</x-guest-layout>

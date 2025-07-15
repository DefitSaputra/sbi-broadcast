<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar - Portal SBI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Kalau pakai Vite --}}
    <style>
        body {
            background-image: url('{{ asset('images/bg-sbi6.jpg') }}'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-900 bg-opacity-70">

    <!-- Overlay Gelap -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    </div>

    <!-- Register Box -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl px-8 py-10 backdrop-blur-sm relative z-10">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/mini-logo.png') }}" alt="Logo SBI" class="h-24">
        </div>

        <!-- Heading -->
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Buat Akun Baru</h2>

        <!-- Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama Lengkap -->
            <div class="mb-4">
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-600" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Alamat Email')" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-600" type="email" name="email" :value="old('email')" required autocomplete="email" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-600" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-600" type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Tombol Daftar -->
            <button type="submit"
                class="w-full justify-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition-colors">
                Daftar
            </button>
        </form>

        <!-- Sudah punya akun? -->
        <div class="mt-6 text-center text-sm text-gray-700">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-red-600 hover:underline">Masuk di sini</a>
        </div>
    </div>

</body>
</html>

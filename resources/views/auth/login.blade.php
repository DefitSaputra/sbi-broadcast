<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal SBI</title>
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

    <!-- Overlay gelap -->
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black bg-opacity-60"></div>
    </div>

    <!-- Login Box -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl px-8 py-10 backdrop-blur-sm relative z-10">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/mini-logo.png') }}" alt="Logo SBI" class="h-24">
        </div>

        <!-- Heading -->
        <h2 class="text-center text-2xl font-bold text-gray-800 mb-6">Masuk ke Portal SBI</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-600" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-600" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between mb-6">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-600" name="remember">
                    <span class="ms-2 text-sm text-gray-700">Ingat saya</span>
                </label>
                @if (Route::has('password.request'))
                    <a class="text-sm text-red-600 hover:underline" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full justify-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition-colors">
                MASUK
            </button>
        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center text-sm text-gray-700">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-red-600 hover:underline">Daftar di sini</a>
        </div>
    </div>

</body>
</html>

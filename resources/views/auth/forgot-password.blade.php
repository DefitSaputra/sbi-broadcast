<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Lupa Password - Portal SBI</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-image: url('{{ asset('images/bg-sbi6.jpg') }}'); /* Ganti sesuai background oranye kamu */
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

    <!-- Box Form -->
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl px-8 py-10 backdrop-blur-sm relative z-10">
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <img src="{{ asset('images/mini-logo.png') }}" alt="Logo SBI" class="h-20">
        </div>

        <!-- Heading -->
        <h2 class="text-center text-xl font-semibold text-gray-800 mb-4">
            Lupa Password?
        </h2>
        <p class="text-sm text-gray-600 text-center mb-6">
            Tenang, masukkan email kamu dan kami akan mengirimkan tautan untuk reset password.
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Form -->
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-red-600 focus:ring-red-600"
                              type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Submit -->
            <div class="mt-6">
                <x-primary-button class="w-full justify-center bg-red-600 hover:bg-red-700 transition-colors">
                    {{ __('Kirim Link Reset Password') }}
                </x-primary-button>
            </div>
        </form>

        <!-- Back to login -->
        <div class="mt-6 text-center text-sm text-gray-700">
            Kembali ke halaman <a href="{{ route('login') }}" class="text-red-600 hover:underline">Login</a>
        </div>
    </div>

</body>
</html>

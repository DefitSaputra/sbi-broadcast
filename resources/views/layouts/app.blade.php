<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @stack('styles')
    </head>
    <body class="antialiased" style="background-image: url('{{ asset('images/bg-sbi1.png') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="min-h-screen bg-black/20 flex flex-col">
            @include('layouts.navigation')

            @if (isset($header))
                <header class="pt-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white/70 backdrop-blur-lg rounded-xl shadow-lg p-6">
                            {{ $header }}
                        </div>
                    </div>
                </header>
            @endif

            <main class="flex-grow">
                {{ $slot }}
            </main>

            <footer class="bg-sbi-dark-gray text-gray-300 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                        <div class="space-y-4">
                            <img src="{{ asset('images/logo-white.svg') }}" alt="Solusi Bangun Indonesia" class="h-10">
                            <p class="text-sm text-gray-400">Copyright © 2025. SBI All rights reserved.</p>
                        </div>

                        <div class="space-y-4">
                            <h4 class="font-bold text-white">Address</h4>
                            <p class="text-sm leading-relaxed">Jl. Ir. Juanda, Padaramai, Karangtalun, Kec. Cilacap Utara, Kabupaten Cilacap, Jawa Tengah 53234</p>
                            <h4 class="font-bold text-white pt-4">Social Media</h4>
                            <div class="flex space-x-4">
                                <a href="https://www.instagram.com/solusibangunid/#" class="hover:text-sbi-green"><i class="fab fa-instagram fa-lg"></i></a>
                                <a href="https://www.linkedin.com/company/solusi-bangun-indonesia/" class="hover:text-sbi-green"><i class="fab fa-linkedin-in fa-lg"></i></a>
                                <a href="https://www.facebook.com/people/PT-Solusi-Bangun-Indonesia-Tbk/61568142358066/?locale=id_ID" class="hover:text-sbi-green"><i class="fab fa-facebook-f fa-lg"></i></a>
                                <a href="https://x.com/solusibangunid" class="hover:text-sbi-green"><i class="fab fa-twitter fa-lg"></i></a>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h4 class="font-bold text-white">Telephone</h4>
                            <p class="text-sm">Tel +62 21 29861000<br>Fax +62 21 29863333</p>
                            <h4 class="font-bold text-white pt-4">Email</h4>
                            <p class="text-sm">corp.comm-sbi@sig.id</p>
                        </div>
                        
                        <div class="space-y-2 flex flex-col">
                            <a href="{{ route('dashboard') }}" class="hover:text-sbi-green text-sm">Dashboard</a>
                            <a href="{{ route('videos.index') }}" class="hover:text-sbi-green text-sm">Manajemen Video</a>
                            <a href="{{ route('schedules.index') }}" class="hover:text-sbi-green text-sm">Manajemen Jadwal</a>
                            <a href="{{ route('siaran.index') }}" class="hover:text-sbi-green text-sm">Siaran</a>
                            <a href="{{ route('profile.edit') }}" class="hover:text-sbi-green text-sm">Profile</a>
                        </div>
                    </div>
                    </div>
            </footer>

            <div class="bg-white/70 backdrop-blur-lg border-t border-white/20">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center text-sm">
                    <a href="#" class="text-gray-700 font-medium hover:text-black">
                        Kebijakan Privasi
                    </a>

                    <p class="text-gray-700 font-medium">
                        Member of 
                        <a href="https://sig.id" target="_blank"><img src="{{ asset('images/SIG-Logo-Dark.svg') }}" alt="SIG Logo" class="inline h-5 ml-2"></a>
                    </p>
                </div>
            </div>

        </div>
    
        @stack('scripts')
    </body>
</html>
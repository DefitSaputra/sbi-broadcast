    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-g">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Siaran Langsung - {{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
        <style>
            body, html {
                margin: 0;
                padding: 0;
                width: 100%;
                height: 100%;
                background-color: #000;
                color: white;
                overflow: hidden; /* Mencegah scroll */
            }
            .broadcast-container {
                position: relative;
                width: 100vw;
                height: 100vh;
            }
            .plyr {
                width: 100%;
                height: 100%;
            }
            .running-text-container {
                position: absolute;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: rgba(0, 0, 0, 0.7);
                white-space: nowrap;
                overflow: hidden;
                box-sizing: border-box;
            }
            .running-text-content {
                display: inline-block;
                padding: 10px 0;
                color: white;
                font-size: 24px;
                font-family: sans-serif;
                animation: marquee 30s linear infinite;
            }
            @keyframes marquee {
                0%   { transform: translateX(100%); }
                100% { transform: translateX(-100%); }
            }
        </style>
    </head>
    <body>
        <div class="broadcast-container">
            @if($broadcast)
                {{-- Jika ada siaran yang aktif --}}
                <video id="player" playsinline controls autoplay>
                    <source src="{{ $broadcast->video->url }}" type="video/mp4" />
                </video>

                @if($broadcast->running_text)
                <div class="running-text-container">
                    <div class="running-text-content">
                        {{ $broadcast->running_text }}
                    </div>
                </div>
                @endif

            @else
                {{-- Tampilan jika tidak ada siaran --}}
                <div class="flex items-center justify-center h-full flex-col">
                    <img src="{{ asset('images/mini-logo.png') }}" alt="Logo" class="w-24 h-24 mb-4">
                    <h1 class="text-3xl font-bold">Saat Ini Tidak Ada Siaran</h1>
                    <p class="text-lg mt-2 text-gray-300">Silakan kembali lagi nanti.</p>
                </div>
            @endif
        </div>

        <script src="https://cdn.plyr.io/3.7.2/plyr.js"></script>
        <script>
            // Inisialisasi Plyr jika ada video
            const player = document.getElementById('player');
            if(player) {
                new Plyr(player);
            }
        </script>
    </body>
    </html>
    
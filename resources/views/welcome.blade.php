<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mon Site Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 relative">
            <img id="background" class="absolute inset-0 object-cover w-full h-full opacity-30" src="img/slider3.jpg" alt="Background médecine" />
    
            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">
                    <header>
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-start space-x-4">
                                @auth
                                    <a href="{{ url('/dashboard') }}" c class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                        Dashboard
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" >
                                        Se connecter
                                    </a>
    
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}"  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            s'enregistrer
                                        </a>
                                    @endif
                                    <div class="flex justify-end">
                                        <h1 class="text-white text-2xl font-bold dark:text-black">Bienvenue à la clinique universitaire</h1>
                                    </div>
                                @endauth
                            </nav>
                        @endif
                    </header>
                </div>
            </div>
        </div>
    </body>
    
    
</html>

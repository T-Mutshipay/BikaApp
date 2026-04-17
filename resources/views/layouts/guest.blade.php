<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Clinique Universitaire de Kinshasa') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900 relative">
    <!-- Background image with overlay -->
    <div aria-hidden="true" class="bg-white absolute inset-0 rounded-lg">
        <img 
            id="background" 
            class="w-full h-full object-cover opacity-25 sm:opacity-30 rounded-lg" 
            src="img/slider3.jpg" 
            alt="Image de fond : médecine" 
            loading="lazy" 
        />
        <div class="absolute inset-0 bg-gradient-to-b from-gray-900/50 to-gray-900/70 sm:bg-gray-900/60"></div>
    </div>

    <!-- Main container -->
    <div class="relative z-10 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <!-- Logo (optionnel) -->
        <div class="mb-6">
            <a href="/" aria-label="Accueil">
                <img 
                    src="{{ asset('img/CUK.png') }}" 
                    alt="Logo de la Clinique Universitaire de Kinshasa" 
                    class="h-16 w-auto m-1  " 
                    loading="lazy"
                />
            </a>
        </div>

        <!-- Slot content -->
        <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            {{ $slot }}
        </div>

        <!-- Footer (optionnel) -->
        <footer class="mt-8 text-center text-sm text-gray-600 dark:text-gray-400">
            &copy; {{ date('Y') }} {{ config('app.name', 'Clinique Universitaire de Kinshasa') }}. Tous droits réservés.
        </footer>
    </div>
</body>
</html>

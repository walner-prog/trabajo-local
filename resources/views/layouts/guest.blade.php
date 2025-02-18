<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Trabajo Local') }}</title>
        <link rel="icon" href="{{ asset('images/logo.png') }}" sizes="100x100" type="image/png">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://cdn.tailwindcss.com"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased dark:bg-gray-900">
        <div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-gray-900">
            
    
            <!-- Contenedor principal con dos columnas -->
            <div class="flex flex-col sm:flex-row items-center bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden mt-6">
                <!-- Sección del logo -->
                <div class="flex items-center justify-center p-8 sm:w-auto">
                    <a href="/" wire:navigate>
                        <x-application-logo class="fill-current text-gray-500" />
                    </a>
                </div>
    
                <!-- Sección del formulario -->
                <div class="w-full sm:w-2/3 p-6">
                    <div class="w-full max-w-md mx-auto p-4 dark:bg-gray-800 ">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    
      
    </body>
    
    
</html>

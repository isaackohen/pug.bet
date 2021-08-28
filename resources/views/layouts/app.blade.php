<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Gamble') }}</title>
        <link rel="icon" type="image/png" href="/img/pug-icon.png">
        <!-- Fontawesome !-->
<script src="https://kit.fontawesome.com/23f13eab24.js" crossorigin="anonymous"></script>        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-body antialiased">
        <x-jet-banner />

        <div class="bg-gray-100 mt-2" style="min-height: calc(100vh - 125px);">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @auth
                <header class="font-header">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        @livewire('balance')
                    </div>
                </header>
            @endauth

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        </div>
        @livewire('footer')

        @stack('modals')

        @livewireScripts
        <x:notify-messages />
    </body>
</html>

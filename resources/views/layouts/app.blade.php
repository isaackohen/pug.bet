<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>
        window.Laravel = {!! 
                json_encode([
                    'csrfToken' => csrf_token(),
                    'userId' => auth()->guest() ? null : auth()->user()->id,
                    'application' => config('app.name')
                ]) 
        !!};
        </script>
        <title>{{ config('app.name', 'Gamble') }}</title>
        <link rel="icon" type="image/png" href="/img/bulk-icon.png">
        <!-- Fontawesome !-->
        <script src="https://kit.fontawesome.com/23f13eab24.js" crossorigin="anonymous"></script>        
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @livewireStyles
        <wireui:styles />

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="/js/extra/loading-bar.min.js" defer></script>
        <wireui:scripts />
        <livewire:scripts/>

    </head>
    <body class="font-body">
        @livewire('modals.jackpot-info')

    @livewire('modals.login')     

        @auth       
            @livewire('modals.wallet')     
            @if(auth()->user()->freespins > 1)
                @livewire('modals.free-spins')
            @endif
        @endauth

        <div class="bg-default">
            @livewire('navigation-menu')

            <!-- Page Content -->
            <main id="app">
                {{ $slot }}
            </main>

        <x-notifications z-index="z-50"/>
        <x-dialog z-index="z-50" blur="sm" align="center" />

        <livewire:notifier/>

        @livewire('footer')
    </body>
</html>

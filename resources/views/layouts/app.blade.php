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
        <link rel="icon" type="image/png" href="/img/pug-icon.png">
        <!-- Fontawesome !-->
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="https://kit.fontawesome.com/23f13eab24.js" crossorigin="anonymous"></script>        

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    </head>
    <body class="font-body-sans">

        <div class="bg-default" style="min-height: calc(100vh - 125px);">


    

            @livewire('navigation-menu')

            <!-- Page Heading -->
            @auth
                <header class="font-header">
                    <div id="second-header" class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
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
        @livewire('auth-modal')

        @stack('modals')
    <livewire:scripts/>
        <livewire:notifier/>

    </body>
</html>

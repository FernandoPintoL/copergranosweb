<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/src/style.css') }}">
        <!-- Scripts -->
        @routes
{{--        @vite(['resources/css/app.css','resources/js/app.js'])--}}
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
        <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
        <script src="{{ asset('assets/fontawesome/js/all.js') }}"></script>
        <script src="{{ asset('assets/src/charts.js') }}"></script>
        <script src="{{ asset('assets/src/constants.js') }}"></script>
        <script src="{{ asset('assets/src/dark-mode.js') }}"></script>
        <script src="{{ asset('assets/src/sidebar.js') }}"></script>
        <script>
            // On page load or when changing themes, best to add inline in `head` to avoid FOUC
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark')
            }
        </script>
    </body>
</html>

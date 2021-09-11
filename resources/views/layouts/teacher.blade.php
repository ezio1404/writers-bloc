<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- Filepond stylesheet -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" defer rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>

<body class="bg-gray-100 h-screen antialiased  font-sans">
    <div id="app">
        <x-teacher-navbar />
        <div class="flex flex-wrap bg-gray-100 w-full h-screen">
            <div class="w-9/12 ml-1/4">
                <div class="p-4 text-gray-500">
                    <div class="bg-white p-4 rounded">

                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    @yield('scripts')
    @include('sweetalert::alert')

</body>

</html>

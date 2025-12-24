<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Matrículas LBGM') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100">

    <div class="min-h-screen flex flex-col items-center justify-center">

        <!-- LOGO -->
        <div class="mb-6">
            <img
                src="{{ asset('images/logo-lbgm.png') }}"
                alt="Liceo Bicentenario Gabriela Mistral"
                class="h-24 w-auto mx-auto"
            />
        </div>

        <!-- CARD LOGIN -->
        <div class="w-full sm:max-w-md px-6 py-6 bg-white shadow-md overflow-hidden rounded-lg">
            {{ $slot }}
        </div>

    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistema de Matrículas | LBGM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased font-sans bg-gray-100">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8 text-center">

            {{-- LOGO --}}
            <div class="flex justify-center mb-6">
                <img
                    src="{{ asset('images/logo-lbgm.png') }}"
                    alt="Liceo Bicentenario Gabriela Mistral"
                    class="h-24 w-auto"
                >
            </div>

            {{-- TITULO --}}
            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Sistema de Matrículas
            </h1>

            {{-- SUBTITULO --}}
            <p class="text-gray-600 mb-8">
                Liceo Bicentenario Gabriela Mistral<br>
                Proceso de Matrícula Escolar
            </p>

            {{-- BOTÓN LOGIN --}}
            <a
                href="{{ route('login') }}"
                class="inline-flex items-center justify-center w-full
                       px-6 py-3 rounded-lg
                       bg-indigo-600 text-white font-semibold
                       hover:bg-indigo-700 transition"
            >
                Iniciar sesión
            </a>

        </div>

    </div>

    {{-- FOOTER --}}
    <footer class="absolute bottom-4 w-full text-center text-sm text-gray-500">
        © {{ date('Y') }} Liceo Bicentenario Gabriela Mistral · Sistema de Matrículas
    </footer>

</body>
</html>
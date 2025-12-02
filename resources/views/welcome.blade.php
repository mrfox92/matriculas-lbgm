<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Vite (solo CSS/JS generales, NO livewire aquí) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="antialiased font-sans">
        <div class="bg-gray-50 text-black/50 dark:bg-black dark:text-white/50">

            <img
                id="background"
                class="absolute -left-20 top-0 max-w-[877px]"
                src="https://laravel.com/assets/img/welcome/background.svg"
            />

            <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">

                <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl">

                    {{-- Header --}}
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        <div class="flex lg:justify-center lg:col-start-2">
                            <x-application-logo class="h-12 w-auto text-white lg:h-16 lg:text-[#FF2D20]" />
                        </div>

                        @if (Route::has('login'))
                            {{-- IMPORTANTE: incluir Blade normal, no Livewire --}}
                            @include('livewire.welcome.navigation')
                        @endif
                    </header>

                    {{-- Main --}}
                    <main class="mt-6">

                        <div class="grid gap-6 lg:grid-cols-2 lg:gap-8">

                            {{-- Documentation --}}
                            <a
                                href="https://laravel.com/docs"
                                class="flex flex-col items-start gap-6 overflow-hidden rounded-lg bg-white p-6 shadow ring-1 ring-gray-200 transition hover:ring-gray-300 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:ring-zinc-700"
                            >
                                <div class="flex items-start gap-6">
                                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-100">
                                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M4.5 12h15m0 0l-6.75 6.75M19.5 12l-6.75-6.75" />
                                        </svg>
                                    </div>

                                    <div>
                                        <h2 class="text-xl font-semibold text-black dark:text-white">Documentation</h2>
                                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                            Laravel has wonderful documentation covering every aspect of the framework.
                                        </p>
                                    </div>
                                </div>
                            </a>

                            {{-- Laracasts --}}
                            <a
                                href="https://laracasts.com"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow ring-1 ring-gray-200 transition hover:ring-gray-300 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:ring-zinc-700"
                            >
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M24 8.25a.5.5 0 0 0-.5-.5H.5a.5.5 0 0 0-.5.5v12a2.5 2.5 0 0 0 2.5 2.5h19a2.5 2.5 0 0 0 2.5-2.5v-12Z" />
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Laracasts</h2>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Thousands of video tutorials on Laravel, PHP, and JavaScript.
                                    </p>
                                </div>
                            </a>

                            {{-- Laravel News --}}
                            <a
                                href="https://laravel-news.com"
                                class="flex items-start gap-4 rounded-lg bg-white p-6 shadow ring-1 ring-gray-200 transition hover:ring-gray-300 dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:ring-zinc-700"
                            >
                                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-red-100">
                                    <svg class="h-6 w-6 text-red-600" viewBox="0 0 24 24">
                                        <path fill="currentColor"
                                            d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/>
                                    </svg>
                                </div>

                                <div>
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Laravel News</h2>
                                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                        Community-driven portal aggregating news about the Laravel ecosystem.
                                    </p>
                                </div>
                            </a>

                        </div>
                    </main>

                    {{-- Footer --}}
                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }}
                        (PHP v{{ PHP_VERSION }})
                    </footer>

                </div>
            </div>
        </div>
    </body>
</html>

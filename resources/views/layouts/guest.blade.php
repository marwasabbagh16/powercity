<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PowerCity – Connexion</title>
        <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>body { font-family: 'Sora', sans-serif; }</style>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white">

            {{-- Logo PowerCity --}}
            <div class="mb-8 text-center">
                <a href="/">
                    <img src="{{ asset('images/logo.png') }}" alt="PowerCity" class="h-26 w-auto mx-auto">
                </a>
            </div>

            {{-- Card --}}
            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-2xl border border-gray-100">
                <h2 class="text-xl font-black mb-6 text-center" style="color:#0d2b45">Connexion</h2>
                {{ $slot }}
            </div>

            <p class="mt-6 text-gray-400 text-xs">
                &copy; {{ date('Y') }} PowerCity – Global Energy Store
            </p>
        </div>
    </body>
</html>
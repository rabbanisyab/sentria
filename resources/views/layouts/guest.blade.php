<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sentria') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|space-grotesk:500,600,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>.font-display{font-family:'Space Grotesk',ui-sans-serif,system-ui,sans-serif;}</style>
</head>

<body class="font-sans antialiased">
    <div class="relative min-h-screen overflow-hidden bg-gradient-to-br from-brand-950 via-brand-800 to-violet-700">

        <!-- Decorative glow -->
        <div class="pointer-events-none absolute -left-32 -top-32 h-96 w-96 rounded-full bg-brand-400/30 blur-3xl"></div>
        <div class="pointer-events-none absolute -bottom-24 -right-24 h-96 w-96 rounded-full bg-violet-400/20 blur-3xl"></div>

        <div class="relative flex min-h-screen items-center justify-center px-6 py-12">
            {{ $slot }}
        </div>
    </div>
</body>
</html>

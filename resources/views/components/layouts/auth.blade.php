<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" x-data="themeManager()" :class="{ 'dark': isDark }">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('messages.app_name')) — {{ __('messages.app_name') }}</title>
    <meta name="description" content="{{ __('messages.app_name') }}">
    <link rel="icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen flex-col font-sans antialiased transition-colors duration-300"
    style="background-color: var(--t-bg); color: var(--t-text);">

    {{-- Header --}}
    @include('partials.header')

    {{-- Main Content (with background) --}}
    <main class="relative flex flex-1 items-center justify-center pt-16"
        style="background: url('{{ asset('assets/background/langit.png') }}') center/cover no-repeat fixed;">
        {{-- Overlay --}}
        <div class="absolute inset-0 transition-colors duration-300"
            style="background-color: var(--t-bg); opacity: 0.85;"></div>

        <div class="relative z-10 w-full">
            {{ $slot }}
        </div>
    </main>

    {{-- Footer --}}
    @include('partials.footer')
</body>

</html>
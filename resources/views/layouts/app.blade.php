<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kaon Ta! Davao – Casia's Food Guide</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-[#f8fbf7] text-[#29251f]">
    <x-nav />
    <main class="mx-auto min-h-[70vh] max-w-6xl px-4 py-10 sm:px-6 lg:px-8">
        @include('partials.flash')
        @yield('content')
    </main>
    <footer class="border-t border-[#d4dfd4] bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-6 text-sm text-[#64756a] sm:px-6 lg:px-8">
            <span class="font-semibold text-[#173d2a]">Kaon Ta! Davao</span>
            <span>Made for Davao food lovers</span>
        </div>
    </footer>
</body>
</html>

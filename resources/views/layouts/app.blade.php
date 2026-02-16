<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aide Plaies Diabétiques - Madagascar')</title>

    <!-- Tailwind CSS (CDN pour le développement) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>

<body class="bg-gray-50 font-sans antialiased">

    <!-- Navigation / Header -->
    @include('layouts.navigation')

    <!-- Contenu principal -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Footer simple -->
    <footer class="bg-white border-t py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center text-gray-500 text-sm">
            © {{ date('Y') }} Aide Plaies Diabétiques - Madagascar<br>
            Tous droits réservés • Site de dons pour les personnes opérées des ulcères diabétiques
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
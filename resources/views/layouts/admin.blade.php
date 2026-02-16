


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
<body class="bg-gray-100 font-sans antialiased">

    <!-- Barre de navigation supérieure -->
    <nav class="bg-white border-b shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-blue-700">
                        Admin - Aide Diabète
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-700">Connecté : {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-medium">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Conteneur principal avec sidebar -->
    <div class="flex min-h-screen">
        <!-- Sidebar (menu latéral) -->
        <aside class="w-64 bg-white border-r shadow-sm">
            <nav class="mt-6 px-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span class="mr-3">📊</span> Tableau de bord
                </a>

                <a href="{{ route('admin.campaigns.index') }}"
                   class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.campaigns.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span class="mr-3">🏥</span> Campagnes
                </a>

                <a href="{{ route('admin.donations.pending') }}"
                   class="flex items-center px-4 py-3 rounded-lg {{ request()->routeIs('admin.donations.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-100' }}">
                    <span class="mr-3">💰</span> Dons en attente
                </a>
            </nav>
        </aside>

        <!-- Contenu principal -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
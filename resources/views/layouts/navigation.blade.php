<!-- resources/views/layouts/navigation.blade.php -->
<nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center text-2xl font-bold text-blue-700">
                🩹 Aide Diabète
            </a>

            <!-- Liens desktop -->
            <div class="hidden md:flex items-center space-x-8 text-sm font-medium">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} py-2">
                    Accueil
                </a>
                <a href="{{ route('campaigns.index') }}"
                    class="{{ request()->routeIs('campaigns.*') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} py-2">
                    Campagnes
                </a>
                <a href="{{ route('comment-donner') }}"
                    class="{{ request()->routeIs('comment-donner') ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-700 hover:text-blue-600' }} py-2">
                    Comment donner
                </a>
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-purple-600 hover:text-purple-700 px-3 py-2 rounded-md text-sm font-medium">
                            Administration
                        </a>
                    @endif

                    <a href="{{ route('campaigns.create') }}"
                        class="text-green-600 hover:text-green-700 px-3 py-2 rounded-md text-sm font-medium">
                        Créer une campagne
                    </a>
                @endauth
            </div>

            <!-- Boutons Auth -->
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 text-sm font-medium">Se
                        connecter</a>
                    <a href="{{ route('register') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium transition">S'inscrire</a>
                @else
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-700">👋 {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="text-red-600 hover:text-red-700 text-sm font-medium">Déconnexion</button>
                        </form>
                    </div>
                @endguest
            </div>

        </div>
    </div>
</nav>

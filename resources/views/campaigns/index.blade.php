@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Campagnes actives</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Découvrez les personnes qui ont besoin de votre aide pour la rééducation, les prothèses et les soins après
                amputation due au diabète.
            </p>
        </div>

        @if ($campaigns->isEmpty())
            <div class="text-center py-16 bg-gray-50 rounded-xl">
                <p class="text-2xl text-gray-500">Aucune campagne active pour le moment.</p>
                <p class="mt-4 text-gray-600">Revenez bientôt ou contactez-nous pour en savoir plus.</p>
            </div>
            @auth
                <div class="text-center mt-12">
                    <a href="{{ route('campaigns.create') }}"
                        class="inline-block bg-green-600 text-white px-8 py-4 rounded-xl text-lg font-bold hover:bg-green-700 shadow-lg transition">
                        Créer ma propre campagne d’aide
                    </a>
                </div>
            @else
                <div class="text-center mt-12 text-gray-600">
                    Connectez-vous pour créer votre propre campagne
                </div>
            @endauth
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($campaigns as $campaign)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300">
                        <!-- Image -->
                        @if ($campaign->main_image)
                            <img src="{{ asset('storage/' . $campaign->main_image) }}" alt="{{ $campaign->title }}"
                                class="w-full h-56 object-cover">
                        @else
                            <div
                                class="w-full h-56 bg-gradient-to-r from-blue-100 to-green-100 flex items-center justify-center">
                                <span class="text-6xl text-gray-300">🩹</span>
                            </div>
                        @endif

                        <div class="p-6">
                            <h2 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">
                                {{ $campaign->title }}
                            </h2>

                            <!-- Barre de progression -->
                            <div class="mb-4">
                                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                    <div class="bg-green-600 h-3 rounded-full transition-all duration-500"
                                        style="width: {{ min(100, $campaign->progress()) }}%"></div>
                                </div>
                                <div class="mt-2 flex justify-between text-sm font-medium">
                                    <span class="text-green-700">
                                        {{ number_format($campaign->current_amount, 0, ',', ' ') }} Ar
                                    </span>
                                    <span class="text-gray-600">
                                        sur {{ number_format($campaign->goal, 0, ',', ' ') }} Ar
                                    </span>
                                </div>
                            </div>

                            <!-- Description courte -->
                            <p class="text-gray-600 mb-6 line-clamp-3">
                                {{ Str::limit(strip_tags($campaign->description), 120) }}
                            </p>

                            <a href="{{ route('campaigns.show', $campaign) }}"
                                class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-medium transition">
                                Voir les détails & Faire un don
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $campaigns->links('pagination::tailwind') }}
            </div>
        @endif

    </div>
@endsection

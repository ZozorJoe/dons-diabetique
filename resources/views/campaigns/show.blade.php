@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-12">

        <div class="max-w-5xl mx-auto">

            <!-- Titre + progression en haut -->
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                    {{ $campaign->title }}
                </h1>

                <div class="inline-flex items-center bg-gray-100 px-6 py-3 rounded-full">
                    <span class="text-2xl font-bold text-green-700 mr-3">
                        {{ number_format($campaign->current_amount, 0, ',', ' ') }} Ar
                    </span>
                    <span class="text-gray-600">sur</span>
                    <span class="text-2xl font-bold text-gray-800 ml-3">
                        {{ number_format($campaign->goal, 0, ',', ' ') }} Ar
                    </span>
                </div>
            </div>

            <!-- Barre de progression large -->
            <div class="mb-12">
                <div class="w-full bg-gray-200 rounded-full h-5 overflow-hidden shadow-inner">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-5 rounded-full transition-all duration-1000"
                        style="width: {{ min(100, $campaign->progress()) }}%"></div>
                </div>
                <p class="text-center mt-3 text-gray-600">
                    {{ round($campaign->progress()) }}% atteint •
                    {{ $campaign->donations->where('status', 'success')->count() }} donateurs
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-10">

                <!-- Colonne principale : histoire + mises à jour -->
                <div class="md:col-span-2">

                    @if ($campaign->main_image)
                        <img src="{{ asset('storage/' . $campaign->main_image) }}" alt="{{ $campaign->title }}"
                            class="w-full h-64 object-cover rounded-xl">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-xl">
                            <span class="text-gray-500">Pas de photo</span>
                        </div>
                    @endif

                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($campaign->description)) !!}
                    </div>

                    <!-- Mises à jour (si tu as déjà le modèle Update) -->
                    @if ($campaign->updates->isNotEmpty())
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold mb-6">Mises à jour</h2>
                            @foreach ($campaign->updates as $update)
                                <div class="border-l-4 border-blue-500 pl-6 py-4 mb-6 bg-gray-50 rounded-r-lg">
                                    <p class="text-gray-700">{{ nl2br(e($update->content)) }}</p>
                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ $update->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Colonne latérale : don + infos -->
                <div class="md:col-span-1">
                    <div class="bg-white p-8 rounded-xl shadow-lg sticky top-8">

                        <h2 class="text-2xl font-bold text-center mb-6">Soutenez cette cause</h2>

                        <div class="text-center mb-8">
                            <p class="text-4xl font-extrabold text-green-700">
                                {{ number_format($campaign->current_amount, 0, ',', ' ') }} Ar
                            </p>
                            <p class="text-gray-500">déjà collectés</p>
                        </div>

                        <a href="{{ route('campaigns.donate', $campaign) }}"
                            class="block w-full bg-green-600 hover:bg-green-700 text-white text-center py-4 rounded-lg font-bold text-lg transition mb-6">
                            Faire un don par virement
                        </a>

                        <div class="text-sm text-gray-600 space-y-3">
                            <p class="font-medium">Pourquoi votre aide compte :</p>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Prothèses et chaussures adaptées</li>
                                <li>Séances de rééducation</li>
                                <li>Suivi médical post-opératoire</li>
                                <li>Médicaments et soins des plaies</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

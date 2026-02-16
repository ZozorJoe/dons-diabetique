@extends('layouts.app')
@section('title', 'Aide aux opérés des plaies diabétiques - Madagascar | Dons & Soutien')
@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Hero section -->
    <div class="relative bg-blue-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight">
                    Aidez les personnes amputées à cause des plaies diabétiques
                </h1>
                <p class="mt-6 text-xl md:text-2xl max-w-3xl mx-auto">
                    À Madagascar, des milliers de personnes perdent un pied ou une jambe chaque année.<br>
                    Votre don finance prothèses, rééducation et soins post-opératoires.
                </p>
                <div class="mt-10">
                    <a href="{{ route('campaigns.index') }}" 
                       class="inline-block bg-white text-blue-700 font-bold px-10 py-5 rounded-lg text-xl hover:bg-gray-100 transition shadow-lg">
                        Voir les campagnes → Donner maintenant
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Campagnes en vedette -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-center mb-12">Campagnes actives</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredCampaigns as $campaign)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    @if($campaign->main_image)
                        <img src="{{ asset('storage/' . $campaign->main_image) }}" 
                             alt="{{ $campaign->title }}" 
                             class="w-full h-56 object-cover">
                    @else
                        <div class="w-full h-56 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-400">Pas de photo</span>
                        </div>
                    @endif
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-3">{{ $campaign->title }}</h3>
                        
                        <div class="mb-4">
                            <div class="w-full bg-gray-200 rounded-full h-3">
                                <div class="bg-green-600 h-3 rounded-full" 
                                     style="width: {{ min(100, $campaign->progress()) }}%"></div>
                            </div>
                            <div class="mt-2 flex justify-between text-sm">
                                <span class="font-medium">{{ number_format($campaign->current_amount, 0, ',', ' ') }} Ar</span>
                                <span class="text-gray-600">sur {{ number_format($campaign->goal, 0, ',', ' ') }} Ar</span>
                            </div>
                        </div>

                        <a href="{{ route('campaigns.show', $campaign) }}" 
                           class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg font-medium hover:bg-blue-700 transition">
                            Voir la campagne & Donner
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-gray-500">
                    Aucune campagne active pour le moment. Revenez bientôt !
                </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('campaigns.index') }}" 
               class="inline-block text-blue-600 font-medium hover:underline text-lg">
                Voir toutes les campagnes →
            </a>
        </div>
    </div>

    <!-- Section Comment donner -->
    <div id="comment-donner" class="bg-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-10">Comment faire un don ?</h2>
            
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl">1</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Choisir une campagne</h3>
                    <p class="text-gray-600">Parcourez les histoires et sélectionnez celle qui vous touche.</p>
                </div>
                
                <div>
                    <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl">2</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Faire un virement</h3>
                    <p class="text-gray-600">Utilisez les coordonnées bancaires affichées (BNI, BOA…).</p>
                </div>
                
                <div>
                    <div class="w-20 h-20 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <span class="text-3xl">3</span>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Envoyer la preuve</h3>
                    <p class="text-gray-600">Téléchargez une capture d'écran. Nous validons rapidement.</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@extends('layouts.app')

@section('title', 'Créer une campagne')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-3xl">

    <h1 class="text-3xl font-bold text-center mb-8">Créer votre campagne d’aide</h1>

    <div class="bg-white rounded-2xl shadow-xl p-8">

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-6">

                <!-- Titre -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Titre de la campagne *</label>
                    <input type="text" name="title" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Ex : Aide pour la prothèse de Rivo après amputation">
                    @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description détaillée *</label>
                    <textarea name="description" rows="8" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                              placeholder="Expliquez la situation, les besoins (prothèse, rééducation, soins...), pourquoi c'est urgent..."></textarea>
                    @error('description') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Objectif financier -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Objectif financier (en Ariary) *</label>
                    <input type="number" name="goal" min="10000" step="1000" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="Ex : 2500000">
                    @error('goal') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Photo principale -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Photo principale (facultative)</label>
                    <input type="file" name="main_image" accept="image/*"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    <p class="text-xs text-gray-500 mt-2">Formats : JPG, PNG – Max 5 Mo</p>
                    @error('main_image') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Consentement (important légal) -->
                <div class="bg-yellow-50 p-4 rounded-xl text-sm text-yellow-800">
                    <label class="flex items-start">
                        <input type="checkbox" name="consent" required class="mt-1 mr-3">
                        <span>
                            Je certifie que j'ai le consentement écrit de la personne concernée pour publier ses informations et sa photo (si applicable). 
                            Je comprends que les campagnes non conformes seront refusées.
                        </span>
                    </label>
                </div>

                <!-- Bouton -->
                <div class="pt-6">
                    <button type="submit" 
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition text-lg shadow-md">
                        Créer ma campagne
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-10 text-center text-gray-600 text-sm">
        Votre campagne sera mise en ligne après vérification par l'équipe (24-48h).
    </div>

</div>
@endsection
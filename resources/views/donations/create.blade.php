@extends('layouts.app')

@section('title', 'Faire un don - ' . $campaign->title)

@section('content')
<div class="container mx-auto px-4 py-10 md:py-16 max-w-5xl">

    <!-- Titre et progression rapide -->
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
            Soutenir : {{ $campaign->title }}
        </h1>

        <div class="inline-flex items-center gap-4 bg-white px-6 py-4 rounded-2xl shadow-sm">
            <div class="text-center">
                <div class="text-3xl font-bold text-green-600">
                    {{ number_format($campaign->current_amount, 0, ',', ' ') }} Ar
                </div>
                <div class="text-sm text-gray-600">déjà collectés</div>
            </div>

            <div class="text-gray-400 text-2xl">/</div>

            <div class="text-center">
                <div class="text-3xl font-bold text-gray-800">
                    {{ number_format($campaign->goal, 0, ',', ' ') }} Ar
                </div>
                <div class="text-sm text-gray-600">objectif</div>
            </div>
        </div>
    </div>

    <!-- Barre de progression visible -->
    <div class="mb-12 max-w-3xl mx-auto">
        <div class="w-full bg-gray-200 rounded-full h-5 overflow-hidden shadow-inner">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 h-full transition-all duration-1000"
                 style="width: {{ min(100, $campaign->progress()) }}%"></div>
        </div>
        <div class="text-center mt-3 text-gray-600 font-medium">
            {{ round($campaign->progress()) }} % atteint • 
            {{ $campaign->donations->where('status', 'success')->count() ?? 0 }} donateurs
        </div>
    </div>

    <div class="grid md:grid-cols-5 gap-10">

        <!-- Colonne gauche : résumé rapide de la campagne -->
        <div class="md:col-span-2">

            @if($campaign->main_image)
                <div class="rounded-2xl overflow-hidden shadow-lg mb-6">
                    <img src="{{ asset('storage/' . $campaign->main_image) }}" 
                         alt="{{ $campaign->title }}" 
                         class="w-full h-64 object-cover">
                </div>
            @endif

            <div class="prose prose-lg max-w-none text-gray-700">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Pourquoi votre aide est importante</h2>
                {!! nl2br(e(Str::limit($campaign->description, 400))) !!}
            </div>

            <div class="mt-8 text-sm text-gray-600">
                <p class="font-medium">Votre don servira directement à :</p>
                <ul class="list-disc pl-5 mt-3 space-y-2">
                    <li>Prothèses ou chaussures orthopédiques</li>
                    <li>Séances de rééducation</li>
                    <li>Soins post-opératoires et médicaments</li>
                    <li>Suivi médical régulier</li>
                </ul>
            </div>
        </div>

        <!-- Colonne droite : formulaire de don -->
        <div class="md:col-span-3">
            <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">

                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">
                    Faire un don par virement bancaire
                </h2>

                <!-- Coordonnées bancaires -->
                <div class="bg-blue-50 p-6 rounded-xl mb-8 text-sm">
                    <h3 class="font-semibold text-blue-800 mb-4 text-lg">Informations bancaires :</h3>
                    
                    <div class="space-y-3">
                        <div>
                            <span class="font-medium">Banque :</span> 
                            {{ config('dons.bank.bank_name') ?? 'BNI Madagascar' }}
                        </div>
                        <div>
                            <span class="font-medium">Titulaire :</span> 
                            {{ config('dons.bank.account_holder') ?? 'Association Aide Plaies Diabétiques' }}
                        </div>
                        <div>
                            <span class="font-medium">N° de compte :</span> 
                            {{ config('dons.bank.account_number') ?? '00000 123 456 789 012 34' }}
                        </div>
                        @if(config('dons.bank.iban'))
                            <div>
                                <span class="font-medium">IBAN :</span> {{ config('dons.bank.iban') }}
                            </div>
                        @endif
                        @if(config('dons.bank.swift'))
                            <div>
                                <span class="font-medium">SWIFT :</span> {{ config('dons.bank.swift') }}
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 pt-4 border-t border-blue-200">
                        <p class="font-medium text-blue-900">
                            Référence obligatoire :
                        </p>
                        <div class="bg-white px-4 py-3 rounded-lg font-mono text-center mt-2 text-lg font-bold text-blue-700 border border-blue-200">
                            {{ config('dons.bank.reference_prefix') ?? 'DON-PLAIES-' }}{{ $campaign->id }}-{{ strtoupper(\Str::random(4)) }}
                        </div>
                        <p class="text-xs text-blue-700 mt-2">
                            Indiquez exactement cette référence lors du virement
                        </p>
                    </div>
                </div>

                <!-- Formulaire -->
                <form action="{{ route('campaigns.donate.store', $campaign) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-6">

                        <!-- Montant -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Montant de votre don (Ariary)
                            </label>
                            <input type="number" name="amount" min="1000" step="100" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent text-lg"
                                   placeholder="Ex: 50000">
                            @error('amount')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Référence (pré-rempli mais modifiable) -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Référence du virement (copiez-collez celle ci-dessus)
                            </label>
                            <input type="text" name="reference" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                   placeholder="Ex: DON-PLAIES-123-ABCD">
                            @error('reference')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preuve de virement -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Joindre la preuve de virement (capture d'écran ou reçu)
                            </label>
                            <input type="file" name="proof" accept="image/*,application/pdf"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-500 mt-2">
                                Formats acceptés : JPG, PNG, PDF – Taille max 5 Mo
                            </p>
                            @error('proof')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bouton soumettre -->
                        <div class="pt-4">
                            <button type="submit"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl transition text-lg shadow-md">
                                Confirmer mon don et envoyer la preuve
                            </button>
                        </div>

                        <p class="text-center text-sm text-gray-600 mt-4">
                            Nous validerons votre don sous 24-48h après réception de la preuve.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
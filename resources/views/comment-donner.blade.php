@extends('layouts.app')
@section('title', 'Aide aux opérés des plaies diabétiques - Madagascar | Dons & Soutien')


@section('content')
<div class="container mx-auto px-4 py-12 md:py-16 max-w-5xl">

    <!-- Titre principal -->
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            Comment faire un don ?
        </h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Votre soutien est simple, sécurisé et arrive directement aux personnes qui en ont besoin.
        </p>
    </div>

    <!-- Étapes en cartes -->
    <div class="grid md:grid-cols-3 gap-8 mb-16">
        
        <!-- Étape 1 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition">
            <div class="w-16 h-16 mx-auto bg-blue-100 rounded-full flex items-center justify-center mb-6">
                <span class="text-3xl font-bold text-blue-600">1</span>
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">Choisir une campagne</h2>
            <p class="text-gray-600 text-center">
                Parcourez les histoires des personnes touchées par les plaies diabétiques et sélectionnez celle qui vous touche le plus.
            </p>
            <div class="text-center mt-6">
                <a href="{{ route('campaigns.index') }}" 
                   class="inline-block text-blue-600 font-medium hover:underline">
                    Voir les campagnes →
                </a>
            </div>
        </div>

        <!-- Étape 2 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition">
            <div class="w-16 h-16 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                <span class="text-3xl font-bold text-green-600">2</span>
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">Faire un virement bancaire</h2>
            <p class="text-gray-600 text-center mb-4">
                Utilisez les coordonnées bancaires affichées sur la page de la campagne.
            </p>
            <div class="bg-gray-50 p-4 rounded-xl text-sm text-center">
                <strong>Banque :</strong> {{ config('dons.bank.bank_name') ?? 'BNI Madagascar' }}<br>
                <strong>Titulaire :</strong> {{ config('dons.bank.account_holder') ?? 'Association Aide Plaies Diabétiques' }}<br>
                <strong>N° compte :</strong> {{ config('dons.bank.account_number') ?? '...' }}
            </div>
        </div>

        <!-- Étape 3 -->
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 hover:shadow-xl transition">
            <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-6">
                <span class="text-3xl font-bold text-emerald-600">3</span>
            </div>
            <h2 class="text-2xl font-bold text-center mb-4">Envoyer la preuve</h2>
            <p class="text-gray-600 text-center mb-4">
                Prenez une capture d'écran ou photo du reçu et téléchargez-la sur le site.
            </p>
            <p class="text-sm text-gray-500 text-center">
                Nous validerons votre don en 24-48h et mettrez à jour la progression de la campagne.
            </p>
        </div>
    </div>

    <!-- Section coordonnées bancaires complètes -->
    <div class="bg-blue-50 rounded-2xl p-8 md:p-12 mb-16">
        <h2 class="text-3xl font-bold text-center text-blue-900 mb-8">
            Coordonnées bancaires pour les virements
        </h2>

        <div class="grid md:grid-cols-2 gap-8 max-w-3xl mx-auto text-lg">
            <div class="space-y-4">
                <p><strong>Banque :</strong> {{ config('dons.bank.bank_name') ?? 'BNI Madagascar' }}</p>
                <p><strong>Titulaire du compte :</strong> {{ config('dons.bank.account_holder') ?? 'Association Aide Plaies Diabétiques' }}</p>
            </div>
            <div class="space-y-4">
                <p><strong>Numéro de compte :</strong> {{ config('dons.bank.account_number') ?? '00000 123 456 789 012 34' }}</p>
                @if(config('dons.bank.iban'))
                    <p><strong>IBAN :</strong> {{ config('dons.bank.iban') }}</p>
                @endif
                @if(config('dons.bank.swift'))
                    <p><strong>SWIFT/BIC :</strong> {{ config('dons.bank.swift') }}</p>
                @endif
            </div>
        </div>

        <div class="mt-10 text-center">
            <p class="text-blue-800 font-medium text-lg mb-4">
                Toujours indiquer la référence fournie sur la page de la campagne
            </p>
            <p class="text-gray-700">
                Exemple : <span class="font-mono bg-white px-3 py-1 rounded">DON-PLAIES-5-XK7P</span>
            </p>
        </div>
    </div>

    <!-- Section confiance & questions -->
    <div class="text-center max-w-3xl mx-auto">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
            Vous avez des questions ?
        </h2>
        <p class="text-lg text-gray-600 mb-8">
            Contactez-nous directement par WhatsApp ou email. Nous répondons rapidement.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-6">
            <a href="https://wa.me/261347052078?text=Bonjour%2C%20je%20souhaite%20faire%20un%20don%20pour%20les%20plaies%20diabétiques" 
               target="_blank"
               class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-medium px-8 py-4 rounded-xl transition text-lg">
                <span class="mr-3 text-2xl">WhatsApp</span> Nous contacter
            </a>
            <a href="mailto:zozorjoe@gmail.com" 
               class="inline-flex items-center bg-gray-700 hover:bg-gray-800 text-white font-medium px-8 py-4 rounded-xl transition text-lg">
                Envoyer un email
            </a>
        </div>
    </div>

</div>
@endsection
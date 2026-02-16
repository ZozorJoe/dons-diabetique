@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-20 text-center">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-4xl font-bold text-green-600 mb-6">Merci infiniment pour votre don !</h1>
        
        <p class="text-xl mb-8">
            Votre contribution par virement est bien enregistrée.<br>
            Nous sommes en train de vérifier la preuve. Vous pouvez suivre l’avancement sur la page de la campagne.
        </p>

        <div class="bg-green-50 p-6 rounded-lg mb-8">
            <p class="text-lg font-medium">Votre geste va vraiment aider quelqu’un.</p>
        </div>

        <a href="{{ route('campaigns.index') }}" 
           class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg text-lg transition">
            Voir les autres campagnes
        </a>
    </div>
</div>
@endsection
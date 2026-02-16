@extends('layouts.app')

@section('title', 'Administration')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-8">Tableau de bord Administration</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-600">Campagnes actives</p>
            <p class="text-4xl font-bold text-blue-600">{{ $activeCampaigns }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-600">Dons en attente</p>
            <p class="text-4xl font-bold text-orange-600">{{ $pendingDonations }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-8">
        <a href="{{ route('admin.campaigns.index') }}"
           class="block bg-blue-600 text-white text-center py-6 rounded-xl text-xl font-medium hover:bg-blue-700 transition">
            Gérer les campagnes
        </a>

        <a href=""
           class="block bg-orange-600 text-white text-center py-6 rounded-xl text-xl font-medium hover:bg-orange-700 transition">
            Voir les dons en attente
        </a>
    </div>

</div>
@endsection
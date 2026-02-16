@extends('layouts.admin')

@section('title', 'Admin - Tableau de bord')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-8">Administration</h1>

    <div class="grid md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-600 text-sm">Campagnes actives</p>
            <p class="text-4xl font-bold text-blue-600">{{ $stats['active_campaigns'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-600 text-sm">Total collecté</p>
            <p class="text-4xl font-bold text-green-600">{{ number_format($stats['total_collected']) }} Ar</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-600 text-sm">Dons en attente</p>
            <p class="text-4xl font-bold text-orange-600">{{ $stats['pending_donations'] }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <p class="text-gray-600 text-sm">Dons validés</p>
            <p class="text-4xl font-bold text-purple-600">{{ $stats['validated_donations'] }}</p>
        </div>
    </div>

    <!-- Campagnes récentes -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold mb-4">Campagnes récentes</h2>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Titre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Objectif</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Collecté</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dons</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentCampaigns as $campaign)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ Str::limit($campaign->title, 40) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($campaign->goal) }} Ar</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($campaign->current_amount) }} Ar</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $campaign->donations_count }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Dons en attente rapides -->
    <div>
        <h2 class="text-2xl font-bold mb-4">Dons en attente (derniers 10)</h2>
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Montant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Campagne</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Référence</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preuve</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($pendingDonations as $don)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ number_format($don->amount) }} Ar</td>
                        <td class="px-6 py-4">{{ Str::limit($don->campaign->title ?? '—', 30) }}</td>
                        <td class="px-6 py-4">{{ $don->reference ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if($don->proof_path)
                                <a href="{{ asset('storage/' . $don->proof_path) }}" target="_blank" class="text-blue-600 hover:underline">Voir preuve</a>
                            @else
                                Pas de preuve
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
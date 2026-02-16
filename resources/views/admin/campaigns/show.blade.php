@extends('layouts.admin')

@section('title', 'Admin - ' . $campaign->title)

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-6">{{ $campaign->title }}</h1>

    <div class="bg-white rounded-xl shadow p-8 mb-8">
        <div class="grid md:grid-cols-2 gap-8">
            <div>
                @if($campaign->main_image)
                    <img src="{{ asset('storage/' . $campaign->main_image) }}" alt="" class="w-full rounded-xl shadow">
                @else
                    <div class="w-full h-64 bg-gray-200 rounded-xl flex items-center justify-center">
                        Pas de photo
                    </div>
                @endif
            </div>
            <div>
                <p class="text-gray-600 mb-2">Créée par : {{ $campaign->user->name ?? '—' }}</p>
                <p class="text-gray-600 mb-4">Objectif : {{ number_format($campaign->goal) }} Ar</p>
                <p class="text-gray-600 mb-4">Collecté : {{ number_format($campaign->current_amount) }} Ar</p>

                <div class="mb-6">
                    <span class="font-semibold">Statut actuel :</span>
                    <span class="ml-2 px-4 py-2 rounded-full text-sm
                        {{ $campaign->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $campaign->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $campaign->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($campaign->status) }}
                    </span>
                </div>

                <!-- Boutons changer statut -->
                @if($campaign->status === 'pending')
                    <div class="flex gap-4">
                        <form action="{{ route('admin.campaigns.update-status', $campaign) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="active">
                            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                                Publier (activer)
                            </button>
                        </form>

                        <form action="{{ route('admin.campaigns.update-status', $campaign) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">
                                Refuser
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-10">
            <h2 class="text-xl font-bold mb-4">Description</h2>
            <div class="prose max-w-none">
                {!! nl2br(e($campaign->description)) !!}
            </div>
        </div>
    </div>

    <!-- Liste des dons pour cette campagne -->
    <h2 class="text-2xl font-bold mb-6">Dons liés à cette campagne</h2>
    @if($campaign->donations->isEmpty())
        <p class="text-gray-600">Aucun don pour le moment.</p>
    @else
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Montant</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Statut</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Référence</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Preuve</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($campaign->donations as $don)
                    <tr>
                        <td class="px-6 py-4">{{ number_format($don->amount) }} Ar</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs
                                {{ $don->status === 'success' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $don->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $don->status === 'failed' ? 'bg-red-100 text-red-800' : '' }}">
                                {{ ucfirst($don->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $don->reference ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if($don->proof_path)
                                <a href="{{ asset('storage/' . $don->proof_path) }}" target="_blank" class="text-blue-600 hover:underline">Voir</a>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
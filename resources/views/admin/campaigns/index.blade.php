@extends('layouts.admin')

@section('title', 'Admin - Campagnes')

@section('content')
    <div class="container mx-auto px-4 py-10">

        <h1 class="text-3xl font-bold mb-8">Liste des campagnes</h1>
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Gestion des campagnes</h1>
            <a href="{{ route('admin.campaigns.create') }}"
                class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                + Nouvelle campagne
            </a>
        </div>
        <div class="bg-white rounded-xl shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Titre</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Créateur</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Objectif</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Collecté</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Statut</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($campaigns as $campaign)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ Str::limit($campaign->title, 50) }}</td>
                            <td class="px-6 py-4">{{ $campaign->user->name ?? '—' }}</td>
                            <td class="px-6 py-4">{{ number_format($campaign->goal) }} Ar</td>
                            <td class="px-6 py-4">{{ number_format($campaign->current_amount) }} Ar</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $campaign->status === 'active' ? 'bg-green-100 text-green-800' : '' }}
                            {{ $campaign->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $campaign->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($campaign->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.campaigns.show', $campaign) }}"
                                    class="text-blue-600 hover:underline">Détails</a>
                                <a href="{{ route('admin.campaigns.edit', $campaign) }}"
                                    class="text-indigo-600 hover:text-indigo-900">Modifier</a>

                                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST"
                                    class="inline ml-4">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Supprimer cette campagne ?');">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4">
                {{ $campaigns->links() }}
            </div>
        </div>

    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Admin - Dons en attente')

@section('content')
<div class="container mx-auto px-4 py-10">

    <h1 class="text-3xl font-bold mb-8">Dons en attente de validation</h1>

    @if($donations->isEmpty())
        <p class="text-gray-600 text-center py-12">Aucun don en attente pour le moment.</p>
    @else
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Montant</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Campagne</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Référence</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Preuve</th>
                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($donations as $donation)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ number_format($donation->amount) }} Ar</td>
                        <td class="px-6 py-4">{{ Str::limit($donation->campaign->title ?? '—', 40) }}</td>
                        <td class="px-6 py-4">{{ $donation->reference ?? '—' }}</td>
                        <td class="px-6 py-4">
                            @if($donation->proof_path)
                                <a href="{{ asset('storage/' . $donation->proof_path) }}" target="_blank" class="text-blue-600 hover:underline">Voir preuve</a>
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('admin.donations.verify', $donation) }}" method="POST" class="inline">
                                @csrf
                                <input type="hidden" name="action" value="approve">
                                <button type="submit" class="text-green-600 hover:text-green-800 font-medium">Valider</button>
                            </form>

                            <form action="{{ route('admin.donations.verify', $donation) }}" method="POST" class="inline ml-6">
                                @csrf
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Rejeter</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="px-6 py-4">
                {{ $donations->links() }}
            </div>
        </div>
    @endif

</div>
@endsection
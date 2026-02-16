@extends('layouts.admin')

@section('title', 'Admin - Nouvelle campagne')

@section('content')
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Créer une nouvelle campagne</h1>

        <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Titre</label>
                    <input type="text" name="title" required class="mt-1 block w-full border rounded-md p-2"
                        value="{{ old('title', $campaign->title) }}">
                    @error('title')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="6" required class="mt-1 block w-full border rounded-md p-2">{{ old('description', $campaign->description) }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Objectif (Ar)</label>
                    <input type="number" name="goal" min="10000" required
                        class="mt-1 block w-full border rounded-md p-2" value="{{ old('goal', $campaign->goal) }}">
                    @error('goal')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Statut initial</label>
                    <select name="status" required class="mt-1 block w-full border rounded-md p-2">
                        <option value="pending" {{ $campaign->status === 'pending' ? 'selected' : '' }} >En attente</option>
                        <option value="active" {{ $campaign->status === 'active' ? 'selected' : '' }} >Publiée</option>
                        <option value="rejected" {{ $campaign->status === 'rejected' ? 'selected' : '' }}>Refusée</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Photo principale (optionnelle)</label>
                    <input type="file" name="main_image" accept="image/*" class="mt-1 block w-full">
                    @error('main_image')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                    Créer la campagne
                </button>
            </div>
        </form>
    </div>
@endsection

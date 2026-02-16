@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl w-full bg-white rounded-2xl shadow-xl p-8">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-700">Créer un compte</h1>
            <p class="text-gray-600 mt-2">Rejoignez-nous pour aider ou créer des campagnes</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-8">
            @csrf

            <!-- Ligne 1 : Nom complet + Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom complet</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Adresse email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Ligne 2 : Nom du contact + Numéro WhatsApp -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nom du contact</label>
                    <input type="text" name="contact_name" value="{{ old('contact_name') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('contact_name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Numéro WhatsApp</label>
                    <input type="tel" name="whatsapp" value="{{ old('whatsapp') }}" required placeholder="+261 34 12 345 67"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('whatsapp')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Ligne 3 : Adresse + Région -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Adresse</label>
                    <input type="text" name="address" value="{{ old('address') }}" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('address')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Région</label>
                    <select name="region" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Choisir une région</option>
                        <option value="Analamanga" {{ old('region') == 'Analamanga' ? 'selected' : '' }}>Analamanga</option>
                        <option value="Atsinanana" {{ old('region') == 'Atsinanana' ? 'selected' : '' }}>Atsinanana</option>
                        <option value="Atsimo-Atsinanana" {{ old('region') == 'Atsimo-Atsinanana' ? 'selected' : '' }}>Atsimo-Atsinanana</option>
                        <option value="Atsimo-Andrefana" {{ old('region') == 'Atsimo-Andrefana' ? 'selected' : '' }}>Atsimo-Andrefana</option>
                        <option value="Amoron'i Mania" {{ old('region') == 'Amoron\'i Mania' ? 'selected' : '' }}>Amoron'i Mania</option>
                        <option value="Bongolava" {{ old('region') == 'Bongolava' ? 'selected' : '' }}>Bongolava</option>
                        <option value="Boeny" {{ old('region') == 'Boeny' ? 'selected' : '' }}>Boeny</option>
                        <option value="Diana" {{ old('region') == 'Diana' ? 'selected' : '' }}>Diana</option>
                        <option value="Haute Matsiatra" {{ old('region') == 'Haute Matsiatra' ? 'selected' : '' }}>Haute Matsiatra</option>
                        <option value="Ihorombe" {{ old('region') == 'Ihorombe' ? 'selected' : '' }}>Ihorombe</option>
                        <option value="Itasy" {{ old('region') == 'Itasy' ? 'selected' : '' }}>Itasy</option>
                        <option value="Melaky" {{ old('region') == 'Melaky' ? 'selected' : '' }}>Melaky</option>
                        <option value="Menabe" {{ old('region') == 'Menabe' ? 'selected' : '' }}>Menabe</option>
                        <option value="Sava" {{ old('region') == 'Sava' ? 'selected' : '' }}>Sava</option>
                        <option value="Sofia" {{ old('region') == 'Sofia' ? 'selected' : '' }}>Sofia</option>
                        <option value="Vakinankaratra" {{ old('region') == 'Vakinankaratra' ? 'selected' : '' }}>Vakinankaratra</option>
                        <option value="Vatovavy Fitovinany" {{ old('region') == 'Vatovavy Fitovinany' ? 'selected' : '' }}>Vatovavy Fitovinany</option>
                        <option value="Ambatosoa" {{ old('region') == 'Ambatosoa' ? 'selected' : '' }}>Ambatosoa</option>
                        <option value="Analanjirofo" {{ old('region') == 'Analanjirofo' ? 'selected' : '' }}>Analanjirofo</option>
                        <option value="Androy" {{ old('region') == 'Androy' ? 'selected' : '' }}>Androy</option>
                        <option value="Anosy" {{ old('region') == 'Anosy' ? 'selected' : '' }}>Anosy</option>
                        <option value="Betsiboka" {{ old('region') == 'Betsiboka' ? 'selected' : '' }}>Betsiboka</option>
                        <option value="Fitovinany" {{ old('region') == 'Fitovinany' ? 'selected' : '' }}>Fitovinany</option>
                        <option value="Matsiatra Ambony" {{ old('region') == 'Matsiatra Ambony' ? 'selected' : '' }}>Matsiatra Ambony</option>
                    </select>
                    @error('region')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Ligne 3 : Mot de passe + Confirmation -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password_confirmation')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Bouton soumission -->
            <div>
                <button type="submit"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-xl transition text-lg shadow-md">
                    Créer mon compte
                </button>
            </div>

            <!-- Lien vers connexion -->
            <div class="text-center text-sm text-gray-600">
                Déjà un compte ?
                <a href="{{ route('login') }}" class="text-blue-600 font-medium hover:underline">Se connecter</a>
            </div>
        </form>
    </div>
</div>
@endsection
<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CampaignController as AdminCampaignController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes publiques (accessibles à tout le monde, même sans connexion)
|
*/

// Page d'accueil
Route::get('/', [CampaignController::class, 'home'])->name('home');

// Liste et détail des campagnes
Route::prefix('campaigns')->name('campaigns.')->group(function () {
    Route::get('/', [CampaignController::class, 'index'])->name('index');
    Route::get('/{campaign}', [CampaignController::class, 'show'])->name('show');
});

// Page "Comment donner"
Route::get('/comment-donner', function () {
    return view('comment-donner');
})->name('comment-donner');

// Formulaire et traitement du don (public ou auth selon ton choix)
Route::prefix('campaigns')->name('campaigns.')->group(function () {
    Route::get('/{campaign}/donate', [DonationController::class, 'create'])->name('donate');
    Route::post('/{campaign}/donate', [DonationController::class, 'store'])->name('donate.store');
});

// Page de remerciement après don
Route::get('/don/merci', [DonationController::class, 'thankyou'])->name('donations.thankyou');

/*
|--------------------------------------------------------------------------
| Routes protégées par authentification (utilisateur connecté)
|
*/

Route::middleware(['auth'])->group(function () {
    // Dashboard utilisateur simple (optionnel)
    Route::get('/dashboard', function () {
        $activeCampaigns = \App\Models\Campaign::where('status', 'active')->count();
        $pendingDonations = \App\Models\Donation::where('status', 'pending')->count();
        return view('dashboard', compact('activeCampaigns', 'pendingDonations'));
    })->name('dashboard');

    // Création de campagne (seulement connecté)
    Route::get('/create/camps', [CampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
});

/*
|--------------------------------------------------------------------------
| Routes ADMIN (seulement pour les utilisateurs avec role = 'admin')
|
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Tableau de bord admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Gestion des campagnes
    Route::get('/campaigns', [AdminCampaignController::class, 'index'])->name('campaigns.index');
    Route::get('/campaigns/{campaign}', [AdminCampaignController::class, 'show'])->name('campaigns.show');
    Route::patch('/campaigns/{campaign}/status', [AdminCampaignController::class, 'updateStatus'])->name('campaigns.update-status');

    // Gestion des dons
    Route::get('/donations/pending', [AdminDonationController::class, 'pending'])->name('donations.pending');
    Route::post('/donations/{donation}/verify', [AdminDonationController::class, 'verify'])->name('donations.verify');

    // Création
    Route::get('/campaigns/crea', [AdminCampaignController::class, 'create'])->name('campaigns.create');
    Route::post('/campaigns', [AdminCampaignController::class, 'store'])->name('campaigns.store');

    // Modification
    Route::get('/campaigns/{campaign}/edit', [AdminCampaignController::class, 'edit'])->name('campaigns.edit');
    Route::put('/campaigns/{campaign}', [AdminCampaignController::class, 'update'])->name('campaigns.update');

    // Suppression (optionnel)
    Route::delete('/campaigns/{campaign}', [AdminCampaignController::class, 'destroy'])->name('campaigns.destroy');
});

// Inclure les routes d'authentification (login, register, etc.)
require __DIR__ . '/auth.php';
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Liste toutes les campagnes (admin)
     */
    public function index()
    {
        $campaigns = Campaign::latest()->paginate(15);
        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Affiche le détail d'une campagne + ses dons
     */
    public function show(Campaign $campaign)
    {
        // Charge les dons triés par date descendante
        $campaign->load(['donations' => function ($query) {
            $query->latest();
        }]);

        return view('admin.campaigns.show', compact('campaign'));
    }

    /**
     * Met à jour le statut d'une campagne (publier/refuser)
     */
    public function updateStatus(Request $request, Campaign $campaign)
    {
        $request->validate([
            'status' => 'required|in:active,pending,rejected'
        ]);

        $campaign->update([
            'status' => $request->status
        ]);

        $messages = [
            'active'   => 'Campagne publiée ! Visible pour tout le monde.',
            'rejected' => 'Campagne refusée.',
            'pending'  => 'Campagne remise en attente.',
        ];

        $message = $messages[$request->status] ?? 'Statut mis à jour.';

        return back()->with('success', $message);
    }

    /**
     * Affiche le formulaire de création d'une campagne
     */
    public function create()
    {
        return view('admin.campaigns.create');
    }

    /**
     * Enregistre une nouvelle campagne depuis l'admin
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'goal'        => 'required|numeric|min:10000',
            'status'      => 'required|in:active,pending,rejected',
            'main_image'  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $campaign = Campaign::create([
            'title'          => $validated['title'],
            'description'    => $validated['description'],
            'goal'           => $validated['goal'],
            'status'         => $validated['status'],
            'current_amount' => 0,
            'user_id'        => auth()->id(), // l'admin qui crée
        ]);

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('campaigns/' . $campaign->id, 'public');
            $campaign->update(['main_image' => $path]);
        }

        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campagne créée avec succès.');
    }

    /**
     * Affiche le formulaire de modification
     */
    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

    /**
     * Met à jour une campagne existante
     */
    public function update(Request $request, Campaign $campaign)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'goal'        => 'required|numeric|min:10000',
            'status'      => 'required|in:active,pending,rejected',
            'main_image'  => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $campaign->update([
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'goal'        => $validated['goal'],
            'status'      => $validated['status'],
        ]);

        if ($request->hasFile('main_image')) {
            $path = $request->file('main_image')->store('campaigns/' . $campaign->id, 'public');
            $campaign->update(['main_image' => $path]);
        }

        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campagne mise à jour avec succès.');
    }

    /**
     * Supprime une campagne (optionnel)
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()
            ->route('admin.campaigns.index')
            ->with('success', 'Campagne supprimée.');
    }
}

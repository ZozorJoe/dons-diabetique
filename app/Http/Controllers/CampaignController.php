<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::where('status', 'active')->latest()->paginate(9);
        return view('campaigns.index', compact('campaigns'));
    }

    public function home()
    {

        $featuredCampaigns = Campaign::where('status', 'active')
            ->orderBy('current_amount', 'desc')
            ->take(6)
            ->get();
        return view('home', compact('featuredCampaigns'));
    }

   
    public function create()
    {
        // dd('test');
        return view('campaigns.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'goal'        => 'required|numeric|min:10000',
            'main_image'  => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        $campaign = Campaign::create([
            'title'          => $validated['title'],
            'description'    => $validated['description'],
            'goal'           => $validated['goal'],
            'current_amount' => 0,
            'status'         => 'pending',           // en attente de validation admin
            'user_id'        => auth()->id(),
        ]);

        // Gestion de l'image (si uploadée)
        if ($request->hasFile('main_image') && $request->file('main_image')->isValid()) {
            $path = $request->file('main_image')->store('campaigns/' . $campaign->id, 'public');
            $campaign->update(['main_image' => $path]);
        }

        return redirect()
            ->route('campaigns.show', $campaign)
            ->with('success', 'Votre campagne a été créée avec succès ! Elle sera visible après validation par l’équipe.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $campaign->load('donations', 'updates');
        return view('campaigns.show', compact('campaign'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

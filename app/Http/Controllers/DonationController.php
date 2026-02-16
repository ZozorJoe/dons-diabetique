<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    public function create(Campaign $campaign)
    {
        return view('donations.create', compact('campaign'));
    }

    public function store(Request $request, Campaign $campaign)
    {
        $request->validate([
            'amount'    => 'required|numeric|min:1000',
            'reference' => 'required|string|max:100',
            'proof'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5 Mo max
        ]);

        $donation = Donation::create([
            'campaign_id'    => $campaign->id,
            'user_id'        => auth()->id() ?? null,
            'amount'         => $request->amount,
            'status'         => 'pending',
            'payment_method' => 'bank_transfer',
            'reference'      => $request->reference,
        ]);

        // Gestion de l'upload de la preuve
        if ($request->hasFile('proof') && $request->file('proof')->isValid()) {
            $path = $request->file('proof')->store('donation-proofs/' . $donation->id, 'public');
            
            $donation->update([
                'proof_path'          => $path,
                'proof_original_name' => $request->file('proof')->getClientOriginalName(),
            ]);
        }

        return redirect()
            ->route('donations.thankyou')
            ->with('success', 'Votre don a bien été enregistré. Merci ! Nous vérifierons la preuve dans les plus brefs délais.');
    }

    public function thankyou()
    {
        return view('donations.thankyou');
    }
}

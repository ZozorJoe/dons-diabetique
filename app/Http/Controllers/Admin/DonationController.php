<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function pending()
    {
        $donations = Donation::with('campaign')
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('admin.donations.pending', compact('donations'));
    }

    public function verify(Request $request, Donation $donation)
    {
        $request->validate(['action' => 'required|in:approve,reject']);

        if ($request->action === 'approve') {
            $donation->update([
                'status'      => 'success',
                'verified_at' => now(),
                'verified_by' => auth()->id(),
            ]);

            $donation->campaign->increment('current_amount', $donation->amount);

            return back()->with('success', 'Don validé – montant ajouté à la campagne.');
        }

        $donation->update([
            'status'      => 'failed',
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with('success', 'Don rejeté.');
    }
}
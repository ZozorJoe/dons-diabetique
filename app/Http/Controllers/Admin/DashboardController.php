<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Donation;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'active_campaigns'   => Campaign::where('status', 'active')->count(),
            'pending_campaigns'  => Campaign::where('status', 'pending')->count(),
            'total_collected'    => Campaign::sum('current_amount'),
            'pending_donations'  => Donation::where('status', 'pending')->count(),
            'validated_donations'=> Donation::where('status', 'success')->count(),
        ];

        // Campagnes récentes (5 dernières)
        $recentCampaigns = Campaign::withCount('donations')->latest()->take(5)->get();

        // Dons en attente (derniers 10)
        $pendingDonations = Donation::with('campaign')
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentCampaigns', 'pendingDonations'));
    }
}
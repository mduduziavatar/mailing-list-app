<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\ContactList;
use App\Models\Campaign;

class DashboardController extends Controller
{
    public function index()
    {
        // Normalize emails and remove duplicates at the database level
        $uniqueEmails = Contact::whereHas('lists')
    ->selectRaw('LOWER(TRIM(email)) as email')
    ->distinct()
    ->get()
    ->pluck('email');

$totalContacts = $uniqueEmails->count();
        $totalLists = ContactList::count();
        $totalCampaigns = Campaign::count();

        $latestLists = ContactList::latest()->take(5)->get();
        $latestCampaigns = Campaign::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalContacts',
            'totalLists',
            'totalCampaigns',
            'latestLists',
            'latestCampaigns'
        ));
    }
}


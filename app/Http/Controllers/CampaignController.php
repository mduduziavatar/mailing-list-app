<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\ContactList;
use Illuminate\Http\Request;
use App\Exports\CampaignsExport;
use Maatwebsite\Excel\Facades\Excel;

class CampaignController extends Controller
{
    public function create()
    {
        $lists = ContactList::all();
        return view('campaigns.create', compact('lists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'message' => 'required|string',
            'contact_list_id' => 'required|exists:contact_lists,id',
        ]);

        Campaign::create($request->all());

        return redirect('/campaigns')->with('success', 'Campaign created.');
    }

    public function index()
    {
        $campaigns = Campaign::with('list')->get();
        return view('campaigns.index', compact('campaigns'));
    }

    public function show($id)
{
    $campaign = Campaign::with(['list.contacts'])->findOrFail($id);
    return view('campaigns.show', compact('campaign'));
}
    public function edit($id)
{
    $campaign = Campaign::findOrFail($id);
    $lists = ContactList::all();
    return view('campaigns.edit', compact('campaign', 'lists'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'subject' => 'required|string',
        'message' => 'required|string',
        'contact_list_id' => 'required|exists:contact_lists,id',
    ]);

    $campaign = Campaign::findOrFail($id);
    $campaign->update($request->all());

    return redirect('/campaigns')->with('success', 'Campaign updated successfully.');
}

public function destroy($id)
{
    Campaign::findOrFail($id)->delete();
    return redirect('/campaigns')->with('success', 'Campaign deleted.');
}
public function export()
{
    return Excel::download(new CampaignsExport, 'campaigns.csv');
}
}


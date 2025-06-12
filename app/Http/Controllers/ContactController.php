<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('edit-contact', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:contacts,email,' . $id,
        ]);
    
        $contact = Contact::findOrFail($id);
        $contact->update([
            'full_name' => $request->full_name,
            'email' => $request->email
        ]);
        return redirect('/')->with('success', 'Contact updated successfully.');
    }

    public function index(Request $request)
{
    $perPage = $request->get('per_page', 10); // default to 10

    $contacts = Contact::whereHas('lists')
        ->with('lists')
        ->when($request->get('name'), function ($query) use ($request) {
            $query->where('full_name', 'like', '%' . $request->get('name') . '%');
        })
        ->when($request->get('email'), function ($query) use ($request) {
            $query->where('email', 'like', '%' . $request->get('email') . '%');
        })
        ->paginate($perPage)
        ->appends($request->query());

    return view('all-contacts', compact('contacts'));
}
}
<?php
namespace App\Http\Controllers;

use App\Models\ContactList;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactListController extends Controller
{
    public function filterContacts($id)
    {
        $query = Contact::whereHas('lists', function ($q) use ($id) {
            $q->where('contact_lists.id', $id); 
        });

        if (request('name')) {
            $query->where('full_name', 'like', '%' . request('name') . '%');
        }

        if (request('email_domain')) {
            $query->where('email', 'like', '%' . request('email_domain'));
        }

        $contacts = $query->get();
        return response()->json($contacts);
    }

    public function viewUI($id)
    {
        $list = ContactList::with('contacts')->findOrFail($id);

        $nameFilter = request('name');
        $emailFilter = request('email_domain');

        $contacts = $list->contacts()
            ->when($nameFilter, fn($q) => $q->where('full_name', 'like', "%$nameFilter%"))
            ->when($emailFilter, fn($q) => $q->where('email', 'like', "%$emailFilter"))
            ->get();

        return view('contacts-ui', compact('list', 'contacts', 'nameFilter', 'emailFilter'));
    }

    public function edit($id)
    {
        $list = ContactList::findOrFail($id);
        return view('edit-contact-list', compact('list'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required']);
        $list = ContactList::findOrFail($id);
        $list->update(['name' => $request->name]);

        return redirect('/contacts-ui/' . $id)->with('success', 'List name updated.');
    }

    public function addContact(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required',
            'email' => 'required|email'
        ]);

        $contact = Contact::firstOrCreate(
            ['email' => $request->email],
            ['full_name' => $request->full_name]
        );

        $list = ContactList::findOrFail($id);
        $list->contacts()->syncWithoutDetaching([$contact->id]);

        return redirect()->back()->with('success', 'Contact added.');
    }

    public function removeContact($list_id, $contact_id)
    {
        $list = ContactList::findOrFail($list_id);
        $list->contacts()->detach($contact_id);

        return redirect()->back()->with('success', 'Contact removed.');
    }

    public function create()
    {
        return view('create-contact-list');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:contact_lists,name',
        ]);

        $list = ContactList::create(['name' => $request->name]);

        return redirect('/')->with('success', 'Contact list created.');
    }

    public function destroy($id)
    {
        $list = ContactList::findOrFail($id);
        $list->delete();

        return redirect('/')->with('success', 'Contact list deleted.');
    }
}
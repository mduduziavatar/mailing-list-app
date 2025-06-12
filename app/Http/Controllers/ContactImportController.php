<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ContactsImport;
use Maatwebsite\Excel\Facades\Excel;
use Exception;

class ContactImportController extends Controller
{
    public function import(Request $request, $id)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,xlsx'
        ]);

        try {
            Excel::import(new ContactsImport($id), $request->file('file'));
            return redirect()->back()->with('success', 'Contacts imported successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to import contacts: ' . $e->getMessage());
        }
    }
}

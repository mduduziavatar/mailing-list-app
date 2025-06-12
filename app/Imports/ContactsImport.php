<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ContactsImport implements ToModel, WithHeadingRow, WithValidation
{
    protected $contactListId;

    public function __construct($contactListId)
    {
        $this->contactListId = $contactListId;
    }

    public function model(array $row)
    {
        // Create or get existing contact
        $contact = Contact::firstOrCreate(
            ['email' => $row['email']],
            ['full_name' => $row['full_name']]
        );

        // Attach contact to the list without duplicating
        $contact->lists()->syncWithoutDetaching([$this->contactListId]);

        return $contact;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string'],
            'email' => [
                'required',
                'email',
                'regex:/^[^@\\s]+@[^@\\s]+\\.[^@\\s]+$/'
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            'email.regex' => 'The email must be a valid email address with a domain (e.g. name@example.com).',
        ];
    }
}
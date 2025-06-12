<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacts - {{ $list->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans p-6">
@include('layouts.nav')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold">{{ $list->name }}</h2>
            
            <a href="{{ url('/') }}" class="text-sm text-blue-600 hover:underline">← Back to Lists</a>
        </div>

        <a href="{{ url('/contact-lists/' . $list->id . '/edit') }}" class="text-blue-500 hover:underline text-sm">✏️ Edit List Name</a>
{{-- Import via Excel --}}
<div class="mb-6">
    <h3 class="text-lg font-semibold mb-2">📤 Import Contacts via Excel</h3>
    <form method="POST" action="{{ url('/contact-lists/' . $list->id . '/import') }}" enctype="multipart/form-data" class="flex flex-wrap items-center gap-4">
        @csrf
        <input type="file" name="file" required class="border px-3 py-1 rounded">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Upload
        </button>
        <a href="{{ url('/download-template') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Download CSV Template
        </a>
    </form>
</div>
        <div class="flex flex-col md:flex-row md:items-end md:space-x-6 space-y-4 md:space-y-0">
    {{-- Add Contact --}}
    <div class="flex-1">
        <h3 class="text-lg font-semibold mb-2">➕ Add New Contact</h3>
        <form method="POST" action="{{ url('/contact-lists/' . $list->id . '/add-contact') }}" class="space-y-2">
            @csrf
            <input type="text" name="full_name" placeholder="Full Name" required class="w-full border rounded px-3 py-1">
            <input type="email" name="email" placeholder="Email Address" required class="w-full border rounded px-3 py-1">
            <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700 w-full">
                Add
            </button>
        </form>
    </div>

    {{-- Filter Contacts --}}
    <div class="flex-1">
        <h3 class="text-lg font-semibold mb-2">🔍 Filter Contacts</h3>
        <form method="GET" action="{{ url()->current() }}" class="space-y-2">
            <input type="text" name="name" placeholder="Name e.g Siphiwe" value="{{ $nameFilter }}" class="w-full border px-2 py-1 rounded">
            <input type="text" name="email_domain" placeholder="Email e.g Domain @example.com" value="{{ $emailFilter }}" class="w-full border px-2 py-1 rounded">
            <button type="submit" class="bg-gray-700 text-white px-4 py-1 rounded hover:bg-gray-800 w-full">
                Filter
            </button>
        </form>
    </div>
</div>

        

        {{-- Contacts Table --}}
        <div>
            <h3 class="text-lg font-semibold mt-6">📇 Contacts in "{{ $list->name }}"</h3>

            <table class="w-full mt-3 border border-gray-300 rounded overflow-hidden">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="p-2 border-b">Full Name</th>
                        <th class="p-2 border-b">Email</th>
                        <th class="p-2 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $contact)
                        <tr class="hover:bg-gray-50">
                            <td class="p-2 border-b">{{ $contact->full_name }}</td>
                            <td class="p-2 border-b">{{ $contact->email }}</td>
                            <td class="p-2 border-b">
                                <form method="POST" action="{{ url('/contact-lists/' . $list->id . '/remove-contact/' . $contact->id) }}" onsubmit="return confirm('Remove this contact?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="p-3 text-center text-gray-500">No contacts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Contacts</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
@include('layouts.nav')

<div class="max-w-5xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">👥 All Contacts</h1>

    <form method="GET" class="mb-4 flex flex-wrap gap-4">
        <input type="text" name="name" value="{{ request('name') }}" placeholder="Filter by name" class="border px-3 py-2 rounded">
        <input type="text" name="email" value="{{ request('email') }}" placeholder="Filter by email" class="border px-3 py-2 rounded">
        <select name="per_page" class="border px-3 py-2 rounded">
            <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
        </select>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Apply</button>
    </form>

    <table class="w-full table-auto bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Full Name</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Lists</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($contacts as $contact)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $contact->full_name }}</td>
                    <td class="px-4 py-2">{{ $contact->email }}</td>
                    <td class="px-4 py-2">
                        @foreach ($contact->lists as $list)
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm inline-block mr-1">{{ $list->name }}</span>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-4 py-2 text-center text-gray-500">No contacts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $contacts->appends(request()->query())->links() }}
    </div>
</div>

</body>
</html>
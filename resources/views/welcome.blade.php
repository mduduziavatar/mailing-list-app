<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Lists</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800">
@include('layouts.nav')

    <div class="max-w-3xl mx-auto py-10 px-4">
        <h1 class="text-2xl font-bold mb-6">📬 Your Contact Lists</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <ul class="space-y-3 mb-6">
            @forelse ($lists as $list)
                <li class="flex justify-between items-center bg-white shadow p-4 rounded border">
                    <div>
                        <a href="{{ url('/contacts-ui/' . $list->id) }}" class="text-lg font-semibold hover:underline">
                            {{ $list->name }}
                        </a>
                        <div class="text-sm text-gray-500">
                            {{ $list->contacts_count }} contact{{ $list->contacts_count === 1 ? '' : 's' }}
                        </div>
                    </div>

                    <form action="{{ url('/contact-lists/' . $list->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this list?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">🗑 Delete</button>
                    </form>
                </li>
            @empty
                <li class="text-gray-500">No contact lists found.</li>
            @endforelse
        </ul>

        <a href="{{ url('/contact-lists/create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            ➕ Create New Contact List
        </a>
    </div>

</body>
</html>
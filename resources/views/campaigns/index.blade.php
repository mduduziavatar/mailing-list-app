<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Campaigns</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 text-gray-800">
@include('layouts.nav')

<div class="max-w-4xl mx-auto">
    <h1 class="text-2xl font-bold mb-6">📨 Campaigns</h1>

    @if(session('success'))
        <div class="text-green-600 mb-4 font-medium">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-4">
        <a href="{{ url('/campaigns/create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm">
            ➕ New Campaign
        </a>
        <a href="{{ url('/campaigns/export') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
            ⬇️ Export Campaigns CSV
        </a>
    </div>

    @if($campaigns->count())
        <ul class="space-y-3">
            @foreach ($campaigns as $campaign)
                <li class="bg-white p-4 rounded shadow flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $campaign->subject }}</h3>
                        <p class="text-sm text-gray-500 mt-1">List: {{ $campaign->list->name }}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ url('/campaigns/' . $campaign->id) }}" class="text-blue-600 hover:underline text-sm">View</a>
                        <a href="{{ url('/campaigns/' . $campaign->id . '/edit') }}" class="text-yellow-600 hover:underline text-sm">Edit</a>
                        <form method="POST" action="{{ url('/campaigns/' . $campaign->id) }}" onsubmit="return confirm('Delete this campaign?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline text-sm">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <div class="text-center text-gray-500 mt-8 italic">
            No campaigns found.
        </div>
    @endif
</div>

</body>
</html>
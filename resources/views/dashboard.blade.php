<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">
    @include('layouts.nav')

    <div class="max-w-4xl mx-auto py-8 px-4">
        <h1 class="text-3xl font-bold mb-6">📊 Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded shadow">
                <p class="text-sm text-gray-500">Total Contact Lists</p>
                <p class="text-2xl font-bold">{{ $totalLists }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-sm text-gray-500">Total Contacts</p>
                <p class="text-2xl font-bold">{{ $totalContacts }}</p>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <p class="text-sm text-gray-500">Total Campaigns</p>
                <p class="text-2xl font-bold">{{ $totalCampaigns }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold mb-3">🆕 Latest Contact Lists</h2>
                <ul class="space-y-2">
                    @foreach($latestLists as $list)
                        <li class="text-blue-600 hover:underline">
                            <a href="{{ url('/contacts-ui/' . $list->id) }}">{{ $list->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold mb-3">📨 Recent Campaigns</h2>
                <ul class="space-y-2">
                    @foreach($latestCampaigns as $camp)
                        <li class="text-blue-600 hover:underline">
                            <a href="{{ url('/campaigns/' . $camp->id) }}">{{ $camp->subject }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Campaign Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 text-gray-800">
@include('layouts.nav')
    <div class="max-w-4xl mx-auto space-y-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">{{ $campaign->subject }}</h1>
            <a href="{{ url('/campaigns') }}" class="text-sm text-blue-600 hover:underline">← Back to Campaigns</a>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Message:</h3>
            <p class="whitespace-pre-wrap">{{ $campaign->message }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-lg font-semibold mb-2">Recipients ({{ $campaign->list->contacts->count() }})</h3>
            @if ($campaign->list->contacts->isNotEmpty())
    <ul class="list-disc pl-6">
        @foreach ($campaign->list->contacts as $contact)
            <li>{{ $contact->full_name }} - {{ $contact->email }}</li>
        @endforeach
    </ul>
@else
    <p class="text-gray-500 italic">
        No recipients found in “{{ $campaign->list->name }}”
    </p>
@endif
        </div>
    </div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Campaign</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/trix/dist/trix.css">
    <script src="https://unpkg.com/trix/dist/trix.js"></script>
</head>
<body class="bg-gray-50 p-6">
@include('layouts.nav')

<div class="max-w-xl mx-auto">
    <h1 class="text-2xl font-bold mb-4">✏️ Edit Campaign</h1>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ $errors->first() }}
        </div>
    @endif

    {{-- Update Campaign --}}
    <form method="POST" action="{{ url('/campaigns/' . $campaign->id) }}">
        @csrf
        @method('PUT')

        <label class="block mb-1 font-semibold">Subject</label>
        <input type="text" name="subject" value="{{ old('subject', $campaign->subject) }}" class="w-full border mb-3 px-3 py-2 rounded">

        <label class="block mb-1 font-semibold">Message</label>
        <input type="text" name="message" value="{{ old('message', $campaign->message) }}" class="w-full border mb-3 px-3 py-2 rounded">
        

        <label class="block mb-1 font-semibold">Contact List</label>
        <select name="contact_list_id" class="w-full border px-3 py-2 rounded mb-4">
            @foreach($lists as $list)
                <option value="{{ $list->id }}" {{ $campaign->contact_list_id == $list->id ? 'selected' : '' }}>{{ $list->name }}</option>
            @endforeach
        </select>

        <div class="flex justify-between">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>

    {{-- Delete Campaign - OUTSIDE the update form --}}
    <form method="POST" action="{{ url('/campaigns/' . $campaign->id) }}" class="mt-4">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-600 hover:underline">🗑️ Delete Campaign</button>
    </form>
</div>
</body>
</html>
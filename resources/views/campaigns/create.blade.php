<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Campaign</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6 text-gray-800">
@include('layouts.nav')
    <div class="max-w-xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">📢 Create New Campaign</h1>

        @if($errors->any())
            <div class="text-red-600 mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/campaigns') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Subject:</label>
                <input type="text" name="subject" required class="w-full border px-3 py-2 rounded">
            </div>

            <div>
                <label class="block font-semibold">Message:</label>
                <textarea name="message" required class="w-full border px-3 py-2 rounded" rows="6"></textarea>
            </div>

            <div>
                <label class="block font-semibold">Send to List:</label>
                <select name="contact_list_id" required class="w-full border px-3 py-2 rounded">
                    <option value="">-- Select a list --</option>
                    @foreach($lists as $list)
                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Campaign</button>
        </form>
    </div>

</body>
</html>
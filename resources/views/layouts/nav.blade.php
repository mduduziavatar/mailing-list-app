<div class="bg-white shadow mb-6">
    <div class="max-w-5xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="text-xl font-semibold text-gray-700">📧 Mailing App</div>
        <div class="space-x-4">
        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-blue-800 font-semibold underline' : 'text-blue-600 hover:underline' }}">
    📋 Lists
</a>

<a href="{{ url('/campaigns') }}" class="{{ request()->is('campaigns*') ? 'text-blue-800 font-semibold underline' : 'text-blue-600 hover:underline' }}">
    📨 Campaigns
</a>

<a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard') ? 'text-blue-800 font-semibold underline' : 'text-blue-600 hover:underline' }}">
    📊 Dashboard
</a>
<a href="{{ url('/contacts') }}" class="{{ request()->is('contacts') ? 'font-bold text-blue-600' : '' }}">👥 Contacts</a>
        </div>
    </div>
</div>
@if(session('success'))
    <div class="bg-green-100 text-green-800 px-4 py-2 mb-4 rounded shadow-sm">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 text-red-800 px-4 py-2 mb-4 rounded shadow-sm">
        {{ session('error') }}
    </div>
@endif
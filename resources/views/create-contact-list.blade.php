@include('layouts.nav')
<h2>Create New Contact List</h2>

<form method="POST" action="{{ url('/contact-lists') }}">
    @csrf

    <label>List Name:</label><br>
    <input type="text" name="name" required><br><br>

    <button type="submit">Create List</button>
</form>
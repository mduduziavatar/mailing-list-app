@include('layouts.nav')
<h2>Edit Contact</h2>

<form method="POST" action="{{ url('/contacts/' . $contact->id) }}">
    @csrf
    @method('PUT')

    <label>Full Name:</label><br>
    <input type="text" name="full_name" value="{{ $contact->full_name }}" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="{{ $contact->email }}" required><br><br>

    <button type="submit">Update Contact</button>
</form>
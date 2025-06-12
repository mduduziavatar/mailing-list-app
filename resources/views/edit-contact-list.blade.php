@include('layouts.nav')
<h2>Edit Contact List</h2>

<form method="POST" action="{{ url('/contact-lists/' . $list->id) }}">
    @csrf
    @method('PUT')

    <label>List Name:</label>
    <input type="text" name="name" value="{{ $list->name }}" required>

    <button type="submit">Update</button>
</form>
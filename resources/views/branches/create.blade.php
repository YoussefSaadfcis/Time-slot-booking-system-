   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('branches.store') }}" method="POST">
    @csrf

    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name" value="{{ old('name') }}" required><br>

    <label for="government">Government:</label><br>
    <input type="text" id="government" name="government" value="{{ old('government') }}" required><br>

    <button type="submit">Create Branch</button>
</form>

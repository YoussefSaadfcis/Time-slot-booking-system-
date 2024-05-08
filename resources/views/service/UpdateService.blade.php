 @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('service.update', $service->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="{{ $service->name }}" required><br>

    <label for="branch_id">Branch ID:</label>
    <input type="text" id="branch_id" name="branch_id" value="{{ $service->branch_id }}" required><br>

    <label for="agent_id">Agent ID:</label>
    <input type="text" id="agent_id" name="agent_id" value="{{ $service->agent_id }}" required><br>

    <label for="image_path">Image Path:</label>
    <input type="text" id="image_path" name="image_path" value="{{ $service->image_path }}" required><br>

    <button type="submit">Update Service</button>
</form>

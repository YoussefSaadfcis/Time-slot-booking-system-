<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h2>Add Product</h2>
    <form action="{{ route('service.store') }}" method="POST">
        @csrf
        <label for="name">Product Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="branch_id">Branch ID:</label><br>
        <input type="text" id="branch_id" name="branch_id" required><br><br>

        <label for="agent_id">Agent ID:</label><br>
        <input type="text" id="agent_id" name="agent_id" required><br><br>

        <label for="image_path">Image Path:</label><br>
        <input type="text" id="image_path" name="image_path" required><br><br>

        <button type="submit">Add Product</button>
    </form>
</body>

</html>

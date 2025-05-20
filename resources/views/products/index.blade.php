<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title></title>
</head>
<body>



<div class="container">
    <h2 class="mb-4">Product List</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Profile Image</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->file_path)
                        <img src="{{ asset('storage/' . $product->file_path) }}" alt="Profile" width="60" height="60">
                    @else
                        N/A
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->email }}</td>
                <td>{{ $product->phonenumber }}</td>
                <td>{{ $product->country }}</td>
                <td>{{ $product->gender }}</td>
                <td>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">Show</a>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach

            @if ($products->isEmpty())
            <tr>
                <td colspan="8" class="text-center">No records found.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

</body>
</html>
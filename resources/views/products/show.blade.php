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
    <h1>Product Details</h1>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>

            <p><strong>Email:</strong> {{ $product->email }}</p>
            <p><strong>Phone Number:</strong> {{ $product->phonenumber }}</p>
            <p><strong>Gender:</strong> {{ $product->gender }}</p>
            <p><strong>Country:</strong> {{ $product->country }}</p>
            <p><strong>Password:</strong> {{ $product->password }}</p> {{-- You might want to hide this! --}}

            @if ($product->file_path)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $product->file_path) }}" alt="Product Image" width="200">
            @else
                <p><strong>Image:</strong> No image uploaded</p>
            @endif

            <div class="mt-4">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
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
    <h2 class="mb-4">Edit Product</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" value="{{ $product->email }}" required>
        </div>

        <div class="mb-3">
            <label for="phonenumber" class="form-label">Phone Number</label>
            <input type="text" name="phonenumber" class="form-control" value="{{ $product->phonenumber }}">
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" class="form-control" value="{{ $product->country }}">
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" id="gender" class="form-control">
    <option value="Male" 
        @if ($product->gender == 'Male') selected @endif>Male</option>

    <option value="Female" 
        @if ($product->gender == 'Female') selected @endif>Female</option>

    <option value="Other" 
        @if ($product->gender == 'Other') selected @endif>Other</option>
</select>
        </div>

        <div class="mb-3">
            <label for="file_path" class="form-label">Profile Image</label><br>
            @if ($product->file_path)
                <img src="{{ asset('storage/' . $product->file_path) }}" alt="Profile" width="100" class="mb-2"><br>
            @endif
            <input type="file" name="file_path" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <small>(Leave blank to keep current password)</small></label>
            <input type="password" name="password" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
          
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phonenumber' => 'required',
        'gender'  => 'required',
        'country' => 'required',
        'password' => 'required',
    ]);

    if ($request->hasFile('file_path')) {
        $file_path = $request->file('file_path')->store('products', 'public');
    } else {
        $file_path = null;
    }

    Product::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phonenumber' => $validatedData['phonenumber'],
        'gender' => $validatedData['gender'],
        'country' => $validatedData['country'],
        'password' => $validatedData['password'],
        'file_path' => $file_path,
    ]);

    return redirect()->route('products.index')
                     ->with('success', 'Product created successfully.');
}


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phonenumber' => 'required',
        'gender' => 'required',
        'country' => 'required',
        'password' => 'required',
        'file_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);


    if ($request->hasFile('file_path')) {

        // Delete old image if exists

        if ($product->file_path && \Storage::disk('public')->exists($product->file_path)) {
            \Storage::disk('public')->delete($product->file_path);
        }

        // Upload new image

        $file_path = $request->file('file_path')->store('products', 'public');
    } else {
        $file_path = $product->file_path; // Keep existing file
    }


    $product->update([

        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'phonenumber' => $validatedData['phonenumber'],
        'gender' => $validatedData['gender'],
        'country' => $validatedData['country'],
        'password' => $validatedData['password'], 
        'file_path' => $file_path,
    ]);

    

    return redirect()->route('products.index')
                     ->with('success', 'Product updated successfully.');

    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
           
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}

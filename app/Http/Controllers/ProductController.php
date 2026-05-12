<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create',  compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'category_id' => 'required',
          'name' => 'required|string|max:255',
          'description' => 'nullable|string',
          'price' => 'required|numeric',
          'stock' => 'required|integer',
          'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

         $imagePath = null;
         if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
           'category_id' => $request->category_id,
           'name' => $request->name,
           'description' => $request->description,
           'price' => $request->price,
           'stock' => $request->stock,
           'image' => $imagePath,
        ]);
         return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
     $request->validate([
        'category_id' => 'required',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $imagePath = $product->image;
    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $imagePath = $request->file('image')->store('products', 'public');
    }

    $product->update([
        'category_id' => $request->category_id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }
    $product->delete();
    return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}

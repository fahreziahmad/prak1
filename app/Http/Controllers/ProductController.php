<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $validated = $request->validated();

        Product::create([
            'name' => $validated['name'],
            'qty' => $validated['quantity'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = \App\Models\Category::all();

        return view('product.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $validated = $request->validated();
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $validated['name'],
            'qty' => $validated['quantity'],
            'price' => $validated['price'],
            'category_id' => $validated['category_id'],
        ]);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate.');
    }
}

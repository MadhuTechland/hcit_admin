<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'required|string',
            'subtitle' => 'nullable|string|max:255',
            'detail_title' => 'nullable|string',
            'detail_description' => 'nullable|string',
            'breadcrumb_title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'detail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'shape_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|string',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('detail_image')) {
            $validated['detail_image'] = $request->file('detail_image')->store('products', 'public');
        }

        if ($request->hasFile('shape_image')) {
            $validated['shape_image'] = $request->file('shape_image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $product->id,
            'description' => 'required|string',
            'subtitle' => 'nullable|string|max:255',
            'detail_title' => 'nullable|string',
            'detail_description' => 'nullable|string',
            'breadcrumb_title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'detail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'shape_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'tags' => 'nullable|string',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        if ($request->hasFile('detail_image')) {
            if ($product->detail_image && Storage::disk('public')->exists($product->detail_image)) {
                Storage::disk('public')->delete($product->detail_image);
            }
            $validated['detail_image'] = $request->file('detail_image')->store('products', 'public');
        }

        if ($request->hasFile('shape_image')) {
            if ($product->shape_image && Storage::disk('public')->exists($product->shape_image)) {
                Storage::disk('public')->delete($product->shape_image);
            }
            $validated['shape_image'] = $request->file('shape_image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        if ($product->shape_image && Storage::disk('public')->exists($product->shape_image)) {
            Storage::disk('public')->delete($product->shape_image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}

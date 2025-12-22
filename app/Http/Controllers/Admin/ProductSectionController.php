<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductSection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductSectionController extends Controller
{
    public function index(Product $product)
    {
        $sections = ProductSection::where('product_id', $product->id)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.product-sections.index', compact('sections', 'product'));
    }

    public function create(Product $product)
    {
        $sectionTypes = [
            'overview' => 'Overview',
            'features' => 'Key Features',
            'benefits' => 'Benefits',
            'specifications' => 'Specifications',
            'use_cases' => 'Use Cases',
            'integrations' => 'Integrations',
            'pricing' => 'Pricing',
            'demo' => 'Demo',
        ];

        return view('admin.product-sections.create', compact('product', 'sectionTypes'));
    }

    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'section_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_data' => 'nullable|json',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        $validated['product_id'] = $product->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('product-sections', 'public');
        }

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('product-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if (isset($validated['additional_data'])) {
            $validated['additional_data'] = json_decode($validated['additional_data'], true);
        }

        ProductSection::create($validated);

        return redirect()->route('admin.products.sections.index', $product)
            ->with('success', 'Section created successfully.');
    }

    public function edit(Product $product, ProductSection $section)
    {
        $sectionTypes = [
            'overview' => 'Overview',
            'features' => 'Key Features',
            'benefits' => 'Benefits',
            'specifications' => 'Specifications',
            'use_cases' => 'Use Cases',
            'integrations' => 'Integrations',
            'pricing' => 'Pricing',
            'demo' => 'Demo',
        ];

        return view('admin.product-sections.edit', compact('product', 'section', 'sectionTypes'));
    }

    public function update(Request $request, Product $product, ProductSection $section)
    {
        $validated = $request->validate([
            'section_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_data' => 'nullable|json',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists($section->image)) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('product-sections', 'public');
        }

        if ($request->hasFile('background_image')) {
            if ($section->background_image && Storage::disk('public')->exists($section->background_image)) {
                Storage::disk('public')->delete($section->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('product-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        if (isset($validated['additional_data'])) {
            $validated['additional_data'] = json_decode($validated['additional_data'], true);
        }

        $section->update($validated);

        return redirect()->route('admin.products.sections.index', $product)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Product $product, ProductSection $section)
    {
        if ($section->image && Storage::disk('public')->exists($section->image)) {
            Storage::disk('public')->delete($section->image);
        }

        if ($section->background_image && Storage::disk('public')->exists($section->background_image)) {
            Storage::disk('public')->delete($section->background_image);
        }

        $section->delete();

        return redirect()->route('admin.products.sections.index', $product)
            ->with('success', 'Section deleted successfully.');
    }
}

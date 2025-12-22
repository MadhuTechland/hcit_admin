<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.industries.index', compact('industries'));
    }

    public function create()
    {
        return view('admin.industries.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:industries,slug',
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
            $validated['image'] = $request->file('image')->store('industries', 'public');
        }

        if ($request->hasFile('detail_image')) {
            $validated['detail_image'] = $request->file('detail_image')->store('industries', 'public');
        }

        if ($request->hasFile('shape_image')) {
            $validated['shape_image'] = $request->file('shape_image')->store('industries', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Industry::create($validated);

        return redirect()->route('admin.industries.index')->with('success', 'Industry created successfully.');
    }

    public function edit(Industry $industry)
    {
        return view('admin.industries.edit', compact('industry'));
    }

    public function update(Request $request, Industry $industry)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:industries,slug,' . $industry->id,
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
            if ($industry->image && Storage::disk('public')->exists($industry->image)) {
                Storage::disk('public')->delete($industry->image);
            }
            $validated['image'] = $request->file('image')->store('industries', 'public');
        }

        if ($request->hasFile('detail_image')) {
            if ($industry->detail_image && Storage::disk('public')->exists($industry->detail_image)) {
                Storage::disk('public')->delete($industry->detail_image);
            }
            $validated['detail_image'] = $request->file('detail_image')->store('industries', 'public');
        }

        if ($request->hasFile('shape_image')) {
            if ($industry->shape_image && Storage::disk('public')->exists($industry->shape_image)) {
                Storage::disk('public')->delete($industry->shape_image);
            }
            $validated['shape_image'] = $request->file('shape_image')->store('industries', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $industry->update($validated);

        return redirect()->route('admin.industries.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy(Industry $industry)
    {
        if ($industry->image && Storage::disk('public')->exists($industry->image)) {
            Storage::disk('public')->delete($industry->image);
        }

        if ($industry->shape_image && Storage::disk('public')->exists($industry->shape_image)) {
            Storage::disk('public')->delete($industry->shape_image);
        }

        $industry->delete();

        return redirect()->route('admin.industries.index')->with('success', 'Industry deleted successfully.');
    }
}

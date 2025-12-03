<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug',
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
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        if ($request->hasFile('detail_image')) {
            $validated['detail_image'] = $request->file('detail_image')->store('services', 'public');
        }

        if ($request->hasFile('shape_image')) {
            $validated['shape_image'] = $request->file('shape_image')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        Service::create($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:services,slug,' . $service->id,
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
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($service->image && Storage::disk('public')->exists($service->image)) {
                Storage::disk('public')->delete($service->image);
            }
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        if ($request->hasFile('detail_image')) {
            if ($service->detail_image && Storage::disk('public')->exists($service->detail_image)) {
                Storage::disk('public')->delete($service->detail_image);
            }
            $validated['detail_image'] = $request->file('detail_image')->store('services', 'public');
        }

        if ($request->hasFile('shape_image')) {
            if ($service->shape_image && Storage::disk('public')->exists($service->shape_image)) {
                Storage::disk('public')->delete($service->shape_image);
            }
            $validated['shape_image'] = $request->file('shape_image')->store('services', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $service->update($validated);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->image && Storage::disk('public')->exists($service->image)) {
            Storage::disk('public')->delete($service->image);
        }

        if ($service->shape_image && Storage::disk('public')->exists($service->shape_image)) {
            Storage::disk('public')->delete($service->shape_image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }
}

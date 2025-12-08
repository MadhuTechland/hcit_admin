<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutPageController extends Controller
{
    public function index()
    {
        $aboutPages = AboutPage::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.about-pages.index', compact('aboutPages'));
    }

    public function create()
    {
        return view('admin.about-pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:about_pages,slug',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_data' => 'nullable|json',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('about-pages', 'public');
        }

        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $request->file('banner_image')->store('about-pages', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if ($request->has('meta_data')) {
            $validated['meta_data'] = json_decode($request->meta_data, true);
        }

        AboutPage::create($validated);

        return redirect()->route('admin.about-pages.index')->with('success', 'About page created successfully.');
    }

    public function edit(AboutPage $aboutPage)
    {
        return view('admin.about-pages.edit', compact('aboutPage'));
    }

    public function update(Request $request, AboutPage $aboutPage)
    {
        $validated = $request->validate([
            'page_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:about_pages,slug,' . $aboutPage->id,
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'meta_data' => 'nullable|json',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        if ($request->hasFile('image')) {
            if ($aboutPage->image && Storage::disk('public')->exists($aboutPage->image)) {
                Storage::disk('public')->delete($aboutPage->image);
            }
            $validated['image'] = $request->file('image')->store('about-pages', 'public');
        }

        if ($request->hasFile('banner_image')) {
            if ($aboutPage->banner_image && Storage::disk('public')->exists($aboutPage->banner_image)) {
                Storage::disk('public')->delete($aboutPage->banner_image);
            }
            $validated['banner_image'] = $request->file('banner_image')->store('about-pages', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        if ($request->has('meta_data')) {
            $validated['meta_data'] = json_decode($request->meta_data, true);
        }

        $aboutPage->update($validated);

        return redirect()->route('admin.about-pages.index')->with('success', 'About page updated successfully.');
    }

    public function destroy(AboutPage $aboutPage)
    {
        if ($aboutPage->image && Storage::disk('public')->exists($aboutPage->image)) {
            Storage::disk('public')->delete($aboutPage->image);
        }

        if ($aboutPage->banner_image && Storage::disk('public')->exists($aboutPage->banner_image)) {
            Storage::disk('public')->delete($aboutPage->banner_image);
        }

        $aboutPage->delete();

        return redirect()->route('admin.about-pages.index')->with('success', 'About page deleted successfully.');
    }
}

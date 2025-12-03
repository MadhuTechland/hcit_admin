<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of blogs
     */
    public function index()
    {
        $blogs = Blog::with(['category', 'tags'])
            ->latest('created_at')
            ->paginate(15);

        $categories = BlogCategory::all();

        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    /**
     * Show the form for creating a new blog
     */
    public function create()
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();

        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created blog
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'author_image' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image upload if provided
        if ($request->hasFile('featured_image_upload')) {
            $path = $request->file('featured_image_upload')->store('blog-images', 'public');
            $validated['featured_image'] = '/storage/' . $path;
        }

        // Create the blog
        $blog = Blog::create($validated);

        // Attach tags if provided
        if (!empty($validated['tags'])) {
            $blog->tags()->attach($validated['tags']);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog created successfully!');
    }

    /**
     * Show the form for editing the specified blog
     */
    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        $tags = BlogTag::all();

        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    /**
     * Update the specified blog
     */
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:255',
            'author_name' => 'nullable|string|max:255',
            'author_image' => 'nullable|string|max:255',
            'category_id' => 'nullable|exists:blog_categories,id',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
        ]);

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image upload if provided
        if ($request->hasFile('featured_image_upload')) {
            $path = $request->file('featured_image_upload')->store('blog-images', 'public');
            $validated['featured_image'] = '/storage/' . $path;
        }

        // Update the blog
        $blog->update($validated);

        // Sync tags
        if (isset($validated['tags'])) {
            $blog->tags()->sync($validated['tags']);
        } else {
            $blog->tags()->detach();
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified blog
     */
    public function destroy(Blog $blog)
    {
        $blog->tags()->detach();
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully!');
    }
}

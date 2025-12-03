<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published()
            ->with(['category', 'tags'])
            ->latest('published_at');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $blogs = $query->paginate($request->get('per_page', 12));

        return response()->json([
            'success' => true,
            'data' => $blogs->items(),
            'meta' => [
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'per_page' => $blogs->perPage(),
                'total' => $blogs->total(),
            ],
        ]);
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->with(['category', 'tags'])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:blogs,slug',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|string',
            'author_name' => 'nullable|string|max:255',
            'author_image' => 'nullable|string',
            'status' => 'nullable|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
        ]);

        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);

        $blog = Blog::create($validated);

        if (!empty($tags)) {
            $blog->tags()->attach($tags);
        }

        $blog->load(['category', 'tags']);

        return response()->json([
            'success' => true,
            'data' => $blog,
        ], 201);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:blog_categories,id',
            'title' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'nullable|string',
            'content' => 'sometimes|string',
            'featured_image' => 'nullable|string',
            'author_name' => 'nullable|string|max:255',
            'author_image' => 'nullable|string',
            'status' => 'nullable|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:blog_tags,id',
        ]);

        $tags = $validated['tags'] ?? null;
        unset($validated['tags']);

        $blog->update($validated);

        if ($tags !== null) {
            $blog->tags()->sync($tags);
        }

        $blog->load(['category', 'tags']);

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully',
        ]);
    }

    public function categories()
    {
        $categories = BlogCategory::withCount('blogs')->get();

        return response()->json([
            'success' => true,
            'data' => $categories,
        ]);
    }

    public function tags()
    {
        $tags = BlogTag::withCount('blogs')->get();

        return response()->json([
            'success' => true,
            'data' => $tags,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use App\Models\HeroSection;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        // Gather statistics
        $stats = [
            'total_blogs' => Blog::count(),
            'published_blogs' => Blog::where('status', 'published')->count(),
            'draft_blogs' => Blog::where('status', 'draft')->count(),
            'total_services' => Service::count(),
            'active_services' => Service::where('is_active', true)->count(),
            'total_hero_sections' => HeroSection::count(),
            'total_categories' => BlogCategory::count(),
            'total_tags' => BlogTag::count(),
        ];

        // Get recent blogs
        $recent_blogs = Blog::with(['category', 'tags'])
            ->latest('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'recent_blogs'));
    }
}

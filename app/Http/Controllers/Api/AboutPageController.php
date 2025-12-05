<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = AboutPage::active()->ordered()->get();
        return response()->json($pages);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $page = AboutPage::where('slug', $slug)->where('is_active', true)->first();

        if (!$page) {
            return response()->json(['message' => 'Page not found'], 404);
        }

        return response()->json($page);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->active()->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $news
        ]);
    }
}

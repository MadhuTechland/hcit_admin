<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Industry;
use Illuminate\Http\Request;

class IndustryController extends Controller
{
    public function index()
    {
        $industries = Industry::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $industries
        ]);
    }

    public function show($slug)
    {
        $industry = Industry::where('slug', $slug)
            ->active()
            ->with(['sections' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $industry
        ]);
    }
}

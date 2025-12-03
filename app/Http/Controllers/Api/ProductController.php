<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->active()
            ->with(['sections' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $services
        ]);
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->active()
            ->with(['sections' => function($query) {
                $query->where('is_active', true)->orderBy('order');
            }])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::active()->ordered()->get();
        return response()->json($partners);
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $partner = Partner::where('slug', $slug)->where('is_active', true)->first();

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        return response()->json($partner);
    }

    /**
     * Get featured partners.
     */
    public function featured()
    {
        $partners = Partner::active()->featured()->ordered()->get();
        return response()->json($partners);
    }
}

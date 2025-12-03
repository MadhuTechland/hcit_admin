<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->query('page', 'home');

        $heroSections = HeroSection::active()
            ->forPage($page)
            ->orderBy('order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $heroSections,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'background_image' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
            'order' => 'nullable|integer',
        ]);

        $heroSection = HeroSection::create($validated);

        return response()->json([
            'success' => true,
            'data' => $heroSection,
        ], 201);
    }

    public function show(HeroSection $heroSection)
    {
        return response()->json([
            'success' => true,
            'data' => $heroSection,
        ]);
    }

    public function update(Request $request, HeroSection $heroSection)
    {
        $validated = $request->validate([
            'page' => 'sometimes|string',
            'title' => 'sometimes|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'background_image' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,inactive',
            'order' => 'nullable|integer',
        ]);

        $heroSection->update($validated);

        return response()->json([
            'success' => true,
            'data' => $heroSection,
        ]);
    }

    public function destroy(HeroSection $heroSection)
    {
        $heroSection->delete();

        return response()->json([
            'success' => true,
            'message' => 'Hero section deleted successfully',
        ]);
    }
}

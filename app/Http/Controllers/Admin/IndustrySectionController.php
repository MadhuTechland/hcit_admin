<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IndustrySection;
use App\Models\Industry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustrySectionController extends Controller
{
    public function index(Industry $industry)
    {
        $sections = IndustrySection::where('industry_id', $industry->id)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.industry-sections.index', compact('sections', 'industry'));
    }

    public function create(Industry $industry)
    {
        $sectionTypes = [
            'overview' => 'Overview',
            'podcast' => 'Podcast',
            'fashion_retail' => 'Fashion & Retail',
            'sub_industries' => 'Sub Industries',
            'expertise' => 'Our Expertise',
            'solutions' => 'CPG Solutions',
            'core_offering' => 'Core Offering',
            'leadership_pulse' => 'Leadership Pulse',
        ];

        return view('admin.industry-sections.create', compact('industry', 'sectionTypes'));
    }

    public function store(Request $request, Industry $industry)
    {
        $validated = $request->validate([
            'section_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_data' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['industry_id'] = $industry->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('industry-sections', 'public');
        }

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('industry-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if (isset($validated['additional_data'])) {
            $validated['additional_data'] = json_decode($validated['additional_data'], true);
        }

        IndustrySection::create($validated);

        return redirect()->route('admin.industries.sections.index', $industry)
            ->with('success', 'Section created successfully.');
    }

    public function edit(Industry $industry, IndustrySection $section)
    {
        $sectionTypes = [
            'overview' => 'Overview',
            'podcast' => 'Podcast',
            'fashion_retail' => 'Fashion & Retail',
            'sub_industries' => 'Sub Industries',
            'expertise' => 'Our Expertise',
            'solutions' => 'CPG Solutions',
            'core_offering' => 'Core Offering',
            'leadership_pulse' => 'Leadership Pulse',
        ];

        return view('admin.industry-sections.edit', compact('industry', 'section', 'sectionTypes'));
    }

    public function update(Request $request, Industry $industry, IndustrySection $section)
    {
        $validated = $request->validate([
            'section_type' => 'required|string',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'additional_data' => 'nullable|json',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists($section->image)) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('industry-sections', 'public');
        }

        if ($request->hasFile('background_image')) {
            if ($section->background_image && Storage::disk('public')->exists($section->background_image)) {
                Storage::disk('public')->delete($section->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('industry-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        if (isset($validated['additional_data'])) {
            $validated['additional_data'] = json_decode($validated['additional_data'], true);
        }

        $section->update($validated);

        return redirect()->route('admin.industries.sections.index', $industry)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Industry $industry, IndustrySection $section)
    {
        if ($section->image && Storage::disk('public')->exists($section->image)) {
            Storage::disk('public')->delete($section->image);
        }

        if ($section->background_image && Storage::disk('public')->exists($section->background_image)) {
            Storage::disk('public')->delete($section->background_image);
        }

        $section->delete();

        return redirect()->route('admin.industries.sections.index', $industry)
            ->with('success', 'Section deleted successfully.');
    }
}

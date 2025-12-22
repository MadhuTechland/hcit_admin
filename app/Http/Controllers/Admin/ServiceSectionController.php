<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceSection;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceSectionController extends Controller
{
    public function index(Service $service)
    {
        $sections = ServiceSection::where('service_id', $service->id)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.service-sections.index', compact('sections', 'service'));
    }

    public function create(Service $service)
    {
        $sectionTypes = [
            'overview' => 'Overview',
            'features' => 'Key Features',
            'benefits' => 'Benefits',
            'process' => 'Our Process',
            'technologies' => 'Technologies',
            'case_study' => 'Case Study',
            'pricing' => 'Pricing',
            'faq' => 'FAQ',
        ];

        return view('admin.service-sections.create', compact('service', 'sectionTypes'));
    }

    public function store(Request $request, Service $service)
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
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        $validated['service_id'] = $service->id;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('service-sections', 'public');
        }

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $request->file('background_image')->store('service-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        if (isset($validated['additional_data'])) {
            $validated['additional_data'] = json_decode($validated['additional_data'], true);
        }

        ServiceSection::create($validated);

        return redirect()->route('admin.services.sections.index', $service)
            ->with('success', 'Section created successfully.');
    }

    public function edit(Service $service, ServiceSection $section)
    {
        $sectionTypes = [
            'overview' => 'Overview',
            'features' => 'Key Features',
            'benefits' => 'Benefits',
            'process' => 'Our Process',
            'technologies' => 'Technologies',
            'case_study' => 'Case Study',
            'pricing' => 'Pricing',
            'faq' => 'FAQ',
        ];

        return view('admin.service-sections.edit', compact('service', 'section', 'sectionTypes'));
    }

    public function update(Request $request, Service $service, ServiceSection $section)
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
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($section->image && Storage::disk('public')->exists($section->image)) {
                Storage::disk('public')->delete($section->image);
            }
            $validated['image'] = $request->file('image')->store('service-sections', 'public');
        }

        if ($request->hasFile('background_image')) {
            if ($section->background_image && Storage::disk('public')->exists($section->background_image)) {
                Storage::disk('public')->delete($section->background_image);
            }
            $validated['background_image'] = $request->file('background_image')->store('service-sections', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        if (isset($validated['additional_data'])) {
            $validated['additional_data'] = json_decode($validated['additional_data'], true);
        }

        $section->update($validated);

        return redirect()->route('admin.services.sections.index', $service)
            ->with('success', 'Section updated successfully.');
    }

    public function destroy(Service $service, ServiceSection $section)
    {
        if ($section->image && Storage::disk('public')->exists($section->image)) {
            Storage::disk('public')->delete($section->image);
        }

        if ($section->background_image && Storage::disk('public')->exists($section->background_image)) {
            Storage::disk('public')->delete($section->background_image);
        }

        $section->delete();

        return redirect()->route('admin.services.sections.index', $service)
            ->with('success', 'Section deleted successfully.');
    }
}

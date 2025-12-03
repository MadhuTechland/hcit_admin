<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::orderBy('order', 'asc')->get();
        return view('admin.contact-info.index', compact('contactInfo'));
    }

    public function create()
    {
        return view('admin.contact-info.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255|unique:contact_info,type',
            'label' => 'required|string|max:255',
            'value' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        ContactInfo::create($validated);

        return redirect()->route('admin.contact-info.index')->with('success', 'Contact Info created successfully.');
    }

    public function edit(ContactInfo $contactInfo)
    {
        return view('admin.contact-info.edit', compact('contactInfo'));
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255|unique:contact_info,type,' . $contactInfo->id,
            'label' => 'required|string|max:255',
            'value' => 'required|string',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'nullable|integer',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $contactInfo->update($validated);

        return redirect()->route('admin.contact-info.index')->with('success', 'Contact Info updated successfully.');
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();

        return redirect()->route('admin.contact-info.index')->with('success', 'Contact Info deleted successfully.');
    }
}

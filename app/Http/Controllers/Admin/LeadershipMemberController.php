<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LeadershipMemberController extends Controller
{
    public function index()
    {
        $leadershipMembers = LeadershipMember::orderBy('order', 'asc')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.leadership-members.index', compact('leadershipMembers'));
    }

    public function create()
    {
        return view('admin.leadership-members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('leadership-members', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        LeadershipMember::create($validated);

        return redirect()->route('admin.leadership-members.index')->with('success', 'Leadership member created successfully.');
    }

    public function edit(LeadershipMember $leadershipMember)
    {
        return view('admin.leadership-members.edit', compact('leadershipMember'));
    }

    public function update(Request $request, LeadershipMember $leadershipMember)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'email' => 'nullable|email|max:255',
            'linkedin_url' => 'nullable|url|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'is_active' => 'nullable',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($leadershipMember->image && Storage::disk('public')->exists($leadershipMember->image)) {
                Storage::disk('public')->delete($leadershipMember->image);
            }
            $validated['image'] = $request->file('image')->store('leadership-members', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $leadershipMember->update($validated);

        return redirect()->route('admin.leadership-members.index')->with('success', 'Leadership member updated successfully.');
    }

    public function destroy(LeadershipMember $leadershipMember)
    {
        if ($leadershipMember->image && Storage::disk('public')->exists($leadershipMember->image)) {
            Storage::disk('public')->delete($leadershipMember->image);
        }

        $leadershipMember->delete();

        return redirect()->route('admin.leadership-members.index')->with('success', 'Leadership member deleted successfully.');
    }
}

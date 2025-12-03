<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        $query = Setting::query();

        if ($request->has('group')) {
            $query->where('group', $request->group);
        }

        $settings = $query->get()->mapWithKeys(function ($setting) {
            return [$setting->key => Setting::get($setting->key)];
        });

        return response()->json([
            'success' => true,
            'data' => $settings,
        ]);
    }

    public function show($key)
    {
        $value = Setting::get($key);

        return response()->json([
            'success' => true,
            'data' => [
                'key' => $key,
                'value' => $value,
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|unique:settings,key',
            'value' => 'required',
            'type' => 'required|in:text,json,boolean',
            'group' => 'required|string',
        ]);

        $setting = Setting::set(
            $validated['key'],
            $validated['value'],
            $validated['type'],
            $validated['group']
        );

        return response()->json([
            'success' => true,
            'data' => $setting,
        ], 201);
    }

    public function update(Request $request, Setting $setting)
    {
        $validated = $request->validate([
            'value' => 'required',
            'type' => 'sometimes|in:text,json,boolean',
            'group' => 'sometimes|string',
        ]);

        $setting->update($validated);

        return response()->json([
            'success' => true,
            'data' => $setting,
        ]);
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response()->json([
            'success' => true,
            'message' => 'Setting deleted successfully',
        ]);
    }
}

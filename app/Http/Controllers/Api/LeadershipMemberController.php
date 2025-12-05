<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMember;
use Illuminate\Http\Request;

class LeadershipMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = LeadershipMember::active()->ordered()->get();
        return response()->json($members);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $member = LeadershipMember::where('id', $id)->where('is_active', true)->first();

        if (!$member) {
            return response()->json(['message' => 'Leadership member not found'], 404);
        }

        return response()->json($member);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $events
        ]);
    }

    public function show($slug)
    {
        $event = Event::where('slug', $slug)->active()->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $event
        ]);
    }
}

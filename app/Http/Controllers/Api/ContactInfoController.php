<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        $contactInfo = ContactInfo::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $contactInfo
        ]);
    }

    public function getByType($type)
    {
        $contactInfo = ContactInfo::where('type', $type)->active()->first();

        return response()->json([
            'success' => true,
            'data' => $contactInfo
        ]);
    }
}

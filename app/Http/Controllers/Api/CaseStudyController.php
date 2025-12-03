<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseStudy;
use Illuminate\Http\Request;

class CaseStudyController extends Controller
{
    public function index()
    {
        $caseStudies = CaseStudy::active()->ordered()->get();

        return response()->json([
            'success' => true,
            'data' => $caseStudies
        ]);
    }

    public function show($slug)
    {
        $caseStudy = CaseStudy::where('slug', $slug)->active()->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $caseStudy
        ]);
    }
}

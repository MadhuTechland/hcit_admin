<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeroSectionController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\CaseStudyController;
use App\Http\Controllers\Api\IndustryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ContactInfoController;

Route::prefix('v1')->group(function () {

    // Public API Routes (for React frontend)
    Route::get('/hero-sections', [HeroSectionController::class, 'index']);
    Route::get('/hero-sections/{heroSection}', [HeroSectionController::class, 'show']);

    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{slug}', [ServiceController::class, 'show']);

    Route::get('/blogs', [BlogController::class, 'index']);
    Route::get('/blogs/{slug}', [BlogController::class, 'show']);
    Route::get('/blog-categories', [BlogController::class, 'categories']);
    Route::get('/blog-tags', [BlogController::class, 'tags']);

    Route::get('/settings', [SettingController::class, 'index']);
    Route::get('/settings/{key}', [SettingController::class, 'show']);

    // News Routes
    Route::get('/news', [NewsController::class, 'index']);
    Route::get('/news/{slug}', [NewsController::class, 'show']);

    // Case Studies Routes
    Route::get('/case-studies', [CaseStudyController::class, 'index']);
    Route::get('/case-studies/{slug}', [CaseStudyController::class, 'show']);

    // Industries Routes
    Route::get('/industries', [IndustryController::class, 'index']);
    Route::get('/industries/{slug}', [IndustryController::class, 'show']);

    // Products Routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);

    // Events Routes
    Route::get('/events', [EventController::class, 'index']);
    Route::get('/events/{slug}', [EventController::class, 'show']);

    // Testimonials Routes
    Route::get('/testimonials', [TestimonialController::class, 'index']);

    // Contact Info Routes
    Route::get('/contact-info', [ContactInfoController::class, 'index']);
    Route::get('/contact-info/{type}', [ContactInfoController::class, 'getByType']);

    // Protected Admin Routes (for Admin panel - will add auth later)
    Route::prefix('admin')->group(function () {

        Route::apiResource('hero-sections', HeroSectionController::class)->except(['index', 'show']);
        Route::apiResource('services', ServiceController::class)->except(['index', 'show']);
        Route::apiResource('blogs', BlogController::class)->except(['index', 'show']);
        Route::apiResource('settings', SettingController::class)->except(['index', 'show']);

    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

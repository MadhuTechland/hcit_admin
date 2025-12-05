<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\CaseStudyController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\IndustrySectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductSectionController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\AboutPageController;
use App\Http\Controllers\Admin\LeadershipMemberController;
use App\Http\Controllers\Admin\PartnerController;

// Frontend route (placeholder - your React app will handle this)
Route::get('/', function () {
    return response()->json([
        'message' => 'HC IT Solutions API',
        'admin_panel' => url('/admin'),
        'api' => url('/api/v1'),
    ]);
});

// Test route to verify routing is working
Route::get('/test', function () {
    return 'Routing is working! Laravel server is running correctly.';
});

// Test admin route - simplified
Route::get('/admin-test', function () {
    return 'Admin routing is working! Controller should work too.';
});

// ============================================
// ADMIN PANEL ROUTES
// ============================================

Route::prefix('admin')->name('admin.')->group(function () {

    // For now, we'll skip authentication to test the admin panel
    // You can add authentication middleware later

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index']);

    // Blog Management
    Route::resource('blogs', BlogController::class);

    // Homepage Content Management
    Route::resource('news', NewsController::class);
    Route::resource('case-studies', CaseStudyController::class);
    Route::resource('industries', IndustryController::class);

    // Industry Sections (nested resource)
    Route::resource('industries.sections', IndustrySectionController::class);

    // Services Management
    Route::resource('services', ServiceController::class);

    // Service Sections (nested resource)
    Route::resource('services.sections', ServiceSectionController::class);

    // Products Management
    Route::resource('products', ProductController::class);

    // Product Sections (nested resource)
    Route::resource('products.sections', ProductSectionController::class);

    Route::resource('events', EventController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contact-info', ContactInfoController::class);

    // About HC IT Management
    Route::resource('about-pages', AboutPageController::class);
    Route::resource('leadership-members', LeadershipMemberController::class);
    Route::resource('partners', PartnerController::class);

    // Placeholder routes for other resources (to be implemented)
    Route::get('/blog-categories', function () {
        return redirect()->route('admin.dashboard')->with('error', 'Blog Categories management coming soon!');
    })->name('blog-categories.index');

    Route::get('/blog-tags', function () {
        return redirect()->route('admin.dashboard')->with('error', 'Blog Tags management coming soon!');
    })->name('blog-tags.index');

    Route::get('/hero-sections', function () {
        return redirect()->route('admin.dashboard')->with('error', 'Hero Sections management coming soon!');
    })->name('hero-sections.index');

    Route::get('/settings', function () {
        return redirect()->route('admin.dashboard')->with('error', 'Settings management coming soon!');
    })->name('settings.index');

    Route::get('/media', function () {
        return redirect()->route('admin.dashboard')->with('error', 'Media Library coming soon!');
    })->name('media.index');

    Route::get('/profile', function () {
        return redirect()->route('admin.dashboard')->with('error', 'Profile management coming soon!');
    })->name('profile');

    // Logout placeholder
    Route::post('/logout', function () {
        return redirect()->route('admin.dashboard')->with('success', 'Logged out successfully!');
    })->name('logout');
});

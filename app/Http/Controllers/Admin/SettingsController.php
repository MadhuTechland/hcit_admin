<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    /**
     * Define all available settings with their metadata
     */
    protected $settingsSchema = [
        'general' => [
            'title' => 'General Settings',
            'description' => 'Basic site information and configuration',
            'icon' => 'bi-gear',
            'fields' => [
                'site_name' => ['label' => 'Site Name', 'type' => 'text', 'placeholder' => 'HC IT Solutions'],
                'site_tagline' => ['label' => 'Tagline', 'type' => 'text', 'placeholder' => 'Innovative IT Solutions'],
                'site_description' => ['label' => 'Site Description', 'type' => 'textarea', 'placeholder' => 'Brief description of your company...'],
                'site_keywords' => ['label' => 'SEO Keywords', 'type' => 'text', 'placeholder' => 'IT, Solutions, Technology'],
                'google_analytics_id' => ['label' => 'Google Analytics ID', 'type' => 'text', 'placeholder' => 'UA-XXXXXXXXX-X or G-XXXXXXXXXX'],
            ]
        ],
        'logos' => [
            'title' => 'Logo Settings',
            'description' => 'Upload and manage your site logos',
            'icon' => 'bi-image',
            'fields' => [
                'logo' => ['label' => 'Main Logo', 'type' => 'image', 'help' => 'Recommended size: 200x60px'],
                'logo_dark' => ['label' => 'Dark Logo', 'type' => 'image', 'help' => 'Logo for dark backgrounds'],
                'logo_small' => ['label' => 'Small Logo / Icon', 'type' => 'image', 'help' => 'Square icon, recommended: 60x60px'],
                'favicon' => ['label' => 'Favicon', 'type' => 'image', 'help' => 'Browser tab icon, recommended: 32x32px or 64x64px'],
                'footer_logo' => ['label' => 'Footer Logo', 'type' => 'image', 'help' => 'Logo displayed in footer section'],
            ]
        ],
        'contact' => [
            'title' => 'Contact Information',
            'description' => 'Company contact details displayed across the site',
            'icon' => 'bi-telephone',
            'fields' => [
                'company_name' => ['label' => 'Company Name', 'type' => 'text', 'placeholder' => 'HC IT Solutions Pvt. Ltd.'],
                'company_email' => ['label' => 'Primary Email', 'type' => 'email', 'placeholder' => 'info@hcitsol.com'],
                'company_phone' => ['label' => 'Primary Phone', 'type' => 'text', 'placeholder' => '+1 234 567 8900'],
                'company_phone_secondary' => ['label' => 'Secondary Phone', 'type' => 'text', 'placeholder' => '+1 234 567 8901'],
                'company_address' => ['label' => 'Address', 'type' => 'textarea', 'placeholder' => '123 Business Street, City, Country'],
                'company_map_url' => ['label' => 'Google Maps Embed URL', 'type' => 'text', 'placeholder' => 'https://maps.google.com/...'],
                'company_working_hours' => ['label' => 'Working Hours', 'type' => 'text', 'placeholder' => 'Mon - Fri: 9:00 AM - 6:00 PM'],
            ]
        ],
        'social' => [
            'title' => 'Social Media Links',
            'description' => 'Connect your social media profiles',
            'icon' => 'bi-share',
            'fields' => [
                'social_facebook' => ['label' => 'Facebook URL', 'type' => 'url', 'placeholder' => 'https://facebook.com/yourpage'],
                'social_twitter' => ['label' => 'Twitter/X URL', 'type' => 'url', 'placeholder' => 'https://twitter.com/yourhandle'],
                'social_linkedin' => ['label' => 'LinkedIn URL', 'type' => 'url', 'placeholder' => 'https://linkedin.com/company/yourcompany'],
                'social_instagram' => ['label' => 'Instagram URL', 'type' => 'url', 'placeholder' => 'https://instagram.com/yourprofile'],
                'social_youtube' => ['label' => 'YouTube URL', 'type' => 'url', 'placeholder' => 'https://youtube.com/channel/yourchannel'],
                'social_github' => ['label' => 'GitHub URL', 'type' => 'url', 'placeholder' => 'https://github.com/yourorg'],
            ]
        ],
        'footer' => [
            'title' => 'Footer Settings',
            'description' => 'Configure footer content and appearance',
            'icon' => 'bi-layout-text-window-reverse',
            'fields' => [
                'footer_about' => ['label' => 'Footer About Text', 'type' => 'textarea', 'placeholder' => 'Brief description about your company for the footer...'],
                'footer_copyright' => ['label' => 'Copyright Text', 'type' => 'text', 'placeholder' => '© 2024 HC IT Solutions. All rights reserved.'],
                'footer_credits' => ['label' => 'Footer Credits', 'type' => 'text', 'placeholder' => 'Designed by HC IT Solutions'],
                'footer_newsletter_title' => ['label' => 'Newsletter Title', 'type' => 'text', 'placeholder' => 'Subscribe to our newsletter'],
                'footer_newsletter_text' => ['label' => 'Newsletter Description', 'type' => 'textarea', 'placeholder' => 'Stay updated with our latest news...'],
            ]
        ],
        'appearance' => [
            'title' => 'Appearance Settings',
            'description' => 'Customize the look and feel of your site',
            'icon' => 'bi-palette',
            'fields' => [
                'primary_color' => ['label' => 'Primary Color', 'type' => 'color', 'placeholder' => '#6366f1'],
                'secondary_color' => ['label' => 'Secondary Color', 'type' => 'color', 'placeholder' => '#8b5cf6'],
                'accent_color' => ['label' => 'Accent Color', 'type' => 'color', 'placeholder' => '#a855f7'],
                'header_style' => ['label' => 'Header Style', 'type' => 'select', 'options' => ['default' => 'Default', 'transparent' => 'Transparent', 'sticky' => 'Sticky']],
                'footer_style' => ['label' => 'Footer Style', 'type' => 'select', 'options' => ['default' => 'Default', 'dark' => 'Dark', 'minimal' => 'Minimal']],
            ]
        ],
    ];

    /**
     * Display settings page
     */
    public function index(Request $request)
    {
        $activeGroup = $request->get('group', 'general');

        // Get all settings grouped
        $settings = Setting::all()->groupBy('group');

        // Convert to key-value pairs
        $settingsData = [];
        foreach ($settings as $group => $items) {
            foreach ($items as $item) {
                $settingsData[$item->key] = Setting::get($item->key);
            }
        }

        return view('admin.settings.index', [
            'settingsSchema' => $this->settingsSchema,
            'settingsData' => $settingsData,
            'activeGroup' => $activeGroup,
        ]);
    }

    /**
     * Update settings
     */
    public function update(Request $request)
    {
        $group = $request->input('group', 'general');

        if (!isset($this->settingsSchema[$group])) {
            return redirect()->back()->with('error', 'Invalid settings group.');
        }

        $fields = $this->settingsSchema[$group]['fields'];

        foreach ($fields as $key => $field) {
            if ($field['type'] === 'image') {
                // Handle file upload
                if ($request->hasFile($key)) {
                    $file = $request->file($key);

                    // Validate image
                    $request->validate([
                        $key => 'image|mimes:jpeg,png,jpg,gif,svg,ico|max:2048'
                    ]);

                    // Delete old file if exists
                    $oldValue = Setting::get($key);
                    if ($oldValue && Storage::disk('public')->exists($oldValue)) {
                        Storage::disk('public')->delete($oldValue);
                    }

                    // Store new file
                    $path = $file->store('settings', 'public');
                    Setting::set($key, $path, 'text', $group);
                }
            } else {
                // Handle regular fields
                $value = $request->input($key);

                if ($value !== null) {
                    $type = $field['type'] === 'checkbox' ? 'boolean' : 'text';
                    Setting::set($key, $value, $type, $group);
                }
            }
        }

        return redirect()
            ->route('admin.settings.index', ['group' => $group])
            ->with('success', ucfirst($group) . ' settings updated successfully!');
    }

    /**
     * Delete a specific image setting
     */
    public function deleteImage(Request $request)
    {
        $key = $request->input('key');
        $setting = Setting::where('key', $key)->first();

        if ($setting) {
            // Delete file from storage
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            // Clear the setting value
            $setting->update(['value' => null]);

            return response()->json(['success' => true, 'message' => 'Image deleted successfully']);
        }

        return response()->json(['success' => false, 'message' => 'Setting not found'], 404);
    }
}

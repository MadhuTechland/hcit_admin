<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General Settings
            ['key' => 'site_name', 'value' => 'HC IT Solutions', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Innovative IT Solutions for Modern Business', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'HC IT Solutions provides cutting-edge technology solutions, web development, mobile apps, and digital transformation services to help businesses thrive in the digital age.', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_keywords', 'value' => 'IT Solutions, Web Development, Mobile Apps, Digital Transformation, Software Development, Cloud Services', 'type' => 'text', 'group' => 'general'],
            ['key' => 'google_analytics_id', 'value' => '', 'type' => 'text', 'group' => 'general'],

            // Logo Settings (empty by default, user will upload)
            ['key' => 'logo', 'value' => null, 'type' => 'text', 'group' => 'logos'],
            ['key' => 'logo_dark', 'value' => null, 'type' => 'text', 'group' => 'logos'],
            ['key' => 'logo_small', 'value' => null, 'type' => 'text', 'group' => 'logos'],
            ['key' => 'favicon', 'value' => null, 'type' => 'text', 'group' => 'logos'],
            ['key' => 'footer_logo', 'value' => null, 'type' => 'text', 'group' => 'logos'],

            // Contact Information
            ['key' => 'company_name', 'value' => 'HC IT Solutions Pvt. Ltd.', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'company_email', 'value' => 'info@hcitsolutions.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'company_phone', 'value' => '+1 (555) 123-4567', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'company_phone_secondary', 'value' => '+1 (555) 987-6543', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'company_address', 'value' => '123 Technology Park, Innovation Street, Silicon Valley, CA 94000, USA', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'company_map_url', 'value' => '', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'company_working_hours', 'value' => 'Monday - Friday: 9:00 AM - 6:00 PM', 'type' => 'text', 'group' => 'contact'],

            // Social Media Links
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/hcitsolutions', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/hcitsolutions', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/hcitsolutions', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/hcitsolutions', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_youtube', 'value' => '', 'type' => 'text', 'group' => 'social'],
            ['key' => 'social_github', 'value' => '', 'type' => 'text', 'group' => 'social'],

            // Footer Settings
            ['key' => 'footer_about', 'value' => 'HC IT Solutions is a leading technology company dedicated to delivering innovative solutions that drive business growth. We specialize in web development, mobile applications, and enterprise software solutions.', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_copyright', 'value' => '© ' . date('Y') . ' HC IT Solutions. All rights reserved.', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_credits', 'value' => 'Designed & Developed by HC IT Solutions', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_newsletter_title', 'value' => 'Subscribe to Our Newsletter', 'type' => 'text', 'group' => 'footer'],
            ['key' => 'footer_newsletter_text', 'value' => 'Stay updated with our latest news, articles, and exclusive offers. Subscribe now!', 'type' => 'text', 'group' => 'footer'],

            // Appearance Settings
            ['key' => 'primary_color', 'value' => '#6366f1', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'secondary_color', 'value' => '#8b5cf6', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'accent_color', 'value' => '#a855f7', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'header_style', 'value' => 'default', 'type' => 'text', 'group' => 'appearance'],
            ['key' => 'footer_style', 'value' => 'default', 'type' => 'text', 'group' => 'appearance'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                [
                    'value' => $setting['value'],
                    'type' => $setting['type'],
                    'group' => $setting['group'],
                ]
            );
        }

        $this->command->info('Settings seeded successfully!');
    }
}

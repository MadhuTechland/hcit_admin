<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'slug' => 'web-development',
                'title' => 'Web Development',
                'icon' => 'Code',
                'short_description' => 'Custom websites and web applications built with modern technologies for optimal performance and user experience.',
                'full_description' => 'Custom websites and web applications built with modern technologies for optimal performance and user experience.',
                'features' => ['Responsive Design', 'Fast Loading Speed', 'Secure & Scalable', 'SEO Optimized'],
                'image' => '/assets/img/services/web-development.jpg',
                'status' => 'active',
                'order' => 1,
            ],
            [
                'slug' => 'mobile-app-development',
                'title' => 'Mobile App Development',
                'icon' => 'Smartphone',
                'short_description' => 'Native and cross-platform mobile applications that engage users and drive business growth.',
                'full_description' => 'Native and cross-platform mobile applications that engage users and drive business growth.',
                'features' => ['iOS & Android', 'User-Friendly Interface', 'Cloud Integration', 'Push Notifications'],
                'image' => '/assets/img/services/mobile-app.jpg',
                'status' => 'active',
                'order' => 2,
            ],
            [
                'slug' => 'seo-services',
                'title' => 'SEO Services',
                'icon' => 'Search',
                'short_description' => 'Comprehensive SEO strategies to improve your search rankings and increase organic traffic.',
                'full_description' => 'Comprehensive SEO strategies to improve your search rankings and increase organic traffic.',
                'features' => ['Keyword Research', 'On-Page SEO', 'Link Building', 'Analytics & Reporting'],
                'image' => '/assets/img/services/seo.jpg',
                'status' => 'active',
                'order' => 3,
            ],
            [
                'slug' => 'ui-ux-design',
                'title' => 'UI/UX Design',
                'icon' => 'PenTool',
                'short_description' => 'Beautiful, intuitive designs that create memorable user experiences and drive conversions.',
                'full_description' => 'Beautiful, intuitive designs that create memorable user experiences and drive conversions.',
                'features' => ['User Research', 'Wireframing', 'Prototyping', 'Usability Testing'],
                'image' => '/assets/img/services/ui-ux.jpg',
                'status' => 'active',
                'order' => 4,
            ],
            [
                'slug' => 'e-commerce-solutions',
                'title' => 'E-Commerce Solutions',
                'icon' => 'ShoppingCart',
                'short_description' => 'Complete e-commerce platforms that make selling online easy and profitable.',
                'full_description' => 'Complete e-commerce platforms that make selling online easy and profitable.',
                'features' => ['Payment Integration', 'Inventory Management', 'Shopping Cart', 'Order Tracking'],
                'image' => '/assets/img/services/ecommerce.jpg',
                'status' => 'active',
                'order' => 5,
            ],
            [
                'slug' => 'digital-marketing',
                'title' => 'Digital Marketing',
                'icon' => 'BarChart',
                'short_description' => 'Data-driven marketing strategies that reach your target audience and maximize ROI.',
                'full_description' => 'Data-driven marketing strategies that reach your target audience and maximize ROI.',
                'features' => ['Social Media Marketing', 'Content Marketing', 'Email Campaigns', 'PPC Advertising'],
                'image' => '/assets/img/services/digital-marketing.jpg',
                'status' => 'active',
                'order' => 6,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceSection;
use App\Models\Product;
use App\Models\ProductSection;

class ServicesAndProductsSetupSeeder extends Seeder
{
    public function run()
    {
        // Create Services
        $digitalCommerce = Service::create([
            'title' => 'Digital Commerce',
            'slug' => 'digital-commerce',
            'description' => 'Transform your business with our comprehensive digital commerce solutions',
            'subtitle' => 'E-Commerce Solutions',
            'detail_title' => 'Comprehensive Digital Commerce Solutions',
            'detail_description' => 'Build, scale, and optimize your online business with our end-to-end digital commerce services',
            'is_active' => true,
            'order' => 1,
        ]);

        $cloudServices = Service::create([
            'title' => 'Cloud Services',
            'slug' => 'cloud-services',
            'description' => 'Scalable and secure cloud infrastructure solutions',
            'subtitle' => 'Cloud & Infrastructure',
            'detail_title' => 'Modern Cloud Solutions',
            'detail_description' => 'Migrate, manage, and optimize your cloud infrastructure',
            'is_active' => true,
            'order' => 2,
        ]);

        $dataAnalytics = Service::create([
            'title' => 'Data & Analytics',
            'slug' => 'data-analytics',
            'description' => 'Turn data into actionable insights with AI-powered analytics',
            'subtitle' => 'Analytics & BI',
            'detail_title' => 'Advanced Data Analytics',
            'detail_description' => 'Harness the power of your data with advanced analytics and AI',
            'is_active' => true,
            'order' => 3,
        ]);

        // Create Service Sections for Digital Commerce
        ServiceSection::create([
            'service_id' => $digitalCommerce->id,
            'section_type' => 'overview',
            'title' => 'Overview',
            'content' => '<div class="container"><div class="row"><div class="col-lg-6"><h3>Next-Generation E-Commerce</h3><p>Build powerful, scalable online stores that drive conversions and deliver exceptional customer experiences.</p></div><div class="col-lg-6"><h3>Our Approach</h3><ul><li>User-centric design</li><li>Performance optimization</li><li>Secure payment processing</li><li>Mobile-first development</li></ul></div></div></div>',
            'order' => 1,
            'is_active' => true,
        ]);

        ServiceSection::create([
            'service_id' => $digitalCommerce->id,
            'section_type' => 'features',
            'title' => 'Key Features',
            'content' => null,
            'additional_data' => json_encode([
                'items' => [
                    ['title' => 'Headless Commerce', 'description' => 'Flexible, API-first architecture', 'icon' => 'fas fa-server'],
                    ['title' => 'Omnichannel', 'description' => 'Seamless across all channels', 'icon' => 'fas fa-network-wired'],
                    ['title' => 'Personalization', 'description' => 'AI-powered recommendations', 'icon' => 'fas fa-user-check'],
                    ['title' => 'Analytics', 'description' => 'Real-time insights', 'icon' => 'fas fa-chart-bar']
                ]
            ]),
            'order' => 2,
            'is_active' => true,
        ]);

        // Create Products
        $hauteLogic = Product::create([
            'title' => 'HauteLogic',
            'slug' => 'hautelogic',
            'description' => 'AI-powered fashion and retail intelligence platform',
            'subtitle' => 'Fashion Intelligence',
            'detail_title' => 'HauteLogic Platform',
            'detail_description' => 'Revolutionary AI platform for fashion and retail businesses',
            'is_active' => true,
            'order' => 1,
        ]);

        $retailPro = Product::create([
            'title' => 'RetailPro Suite',
            'slug' => 'retailpro-suite',
            'description' => 'Complete retail management solution',
            'subtitle' => 'Retail Management',
            'detail_title' => 'All-in-One Retail Platform',
            'detail_description' => 'Manage your entire retail operations from one platform',
            'is_active' => true,
            'order' => 2,
        ]);

        // Create Product Sections for HauteLogic
        ProductSection::create([
            'product_id' => $hauteLogic->id,
            'section_type' => 'overview',
            'title' => 'Overview',
            'content' => '<div class="container"><div class="row"><div class="col-lg-12"><h3>AI-Powered Fashion Intelligence</h3><p>HauteLogic transforms how fashion brands make decisions with predictive analytics and AI-driven insights.</p><ul><li>Trend forecasting</li><li>Demand prediction</li><li>Inventory optimization</li><li>Customer insights</li></ul></div></div></div>',
            'order' => 1,
            'is_active' => true,
        ]);

        ProductSection::create([
            'product_id' => $hauteLogic->id,
            'section_type' => 'features',
            'title' => 'Key Capabilities',
            'additional_data' => json_encode([
                'items' => [
                    ['title' => 'Trend Analysis', 'description' => 'AI-powered trend forecasting', 'icon' => 'fas fa-chart-line'],
                    ['title' => 'Demand Planning', 'description' => 'Accurate demand predictions', 'icon' => 'fas fa-boxes'],
                    ['title' => 'Style Recommendations', 'description' => 'Personalized style suggestions', 'icon' => 'fas fa-heart'],
                    ['title' => 'Market Intelligence', 'description' => 'Competitive insights', 'icon' => 'fas fa-globe']
                ]
            ]),
            'order' => 2,
            'is_active' => true,
        ]);

        $this->command->info('Services and Products setup completed successfully!');
        $this->command->info('Created Services: ' . Service::count());
        $this->command->info('Created Products: ' . Product::count());
    }
}

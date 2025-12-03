<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Industry;
use App\Models\IndustrySection;

class IndustrySectionsSeeder extends Seeder
{
    public function run()
    {
        // Find the retail-cpg industry
        $industry = Industry::where('slug', 'retail-cpg')->first();

        if (!$industry) {
            $this->command->error('Industry with slug "retail-cpg" not found!');
            return;
        }

        // Clear existing sections for this industry
        IndustrySection::where('industry_id', $industry->id)->delete();

        // 1. Overview Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'overview',
            'title' => 'Overview',
            'subtitle' => null,
            'description' => 'Transforming retail and consumer goods through innovative solutions',
            'content' => '<div class="container"><div class="row"><div class="col-lg-6 mb-3"><div class="overview-content-box p-4 p-md-5"><h3 class="mb-3">Driving Transformation in Retail & Consumer Goods</h3><p class="text-red"><i>Today\'s customers demand personalized, seamless experiences across all channels.</i></p><p>We focus on creating human-centric digital experiences that unlock new opportunities for sustainable growth.</p></div></div><div class="col-lg-6 mb-3"><div class="overview-content-box p-4 p-md-5"><h3 class="mb-3">HC IT: Your Partner in Innovation</h3><p>With 30+ years of global experience, HC IT brings expertise across retail, CPG, and digital transformation.</p><ul class="custom-list mt-3"><li><strong>Omnichannel Excellence:</strong> Integrated, seamless customer journeys.</li><li><strong>Integrated Supply Chain:</strong> Improved speed-to-market & resilience.</li><li><strong>AI & Data Analytics:</strong> Actionable insights for smarter decisions.</li></ul></div></div></div></div>',
            'order' => 1,
            'is_active' => true,
        ]);

        // 2. Podcast Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'podcast',
            'title' => 'Retail Unlocked',
            'subtitle' => 'Podcast',
            'description' => 'Listen to industry leaders discuss the future of retail',
            'content' => null,
            'additional_data' => json_encode([
                'items' => [
                    [
                        'title' => 'Scaling smart: Using AI to drive value in the Lifestyle & Fitness industry',
                        'description' => 'Guest: Joshua Ainsley, Head of Data Science, New Balance | Host: Ali Zubairy',
                        'image' => null,
                        'link' => '#'
                    ],
                    [
                        'title' => 'Beyond the Checkout: Transforming Fashion Retail through Digital Innovation',
                        'description' => 'Guest: Katerina Suh, VP of Information Systems, Delta Galil | Host: Ali Zubairy',
                        'image' => null,
                        'link' => '#'
                    ]
                ]
            ]),
            'order' => 2,
            'is_active' => true,
        ]);

        // 3. Fashion & Retail Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'fashion_retail',
            'title' => 'Fashion & Retail Innovation',
            'subtitle' => 'Transforming the Customer Experience',
            'description' => 'Delivering cutting-edge solutions for fashion and retail brands',
            'content' => '<div class="container"><div class="row"><div class="col-lg-12"><p>The fashion and retail industry is undergoing rapid transformation. HC IT Solutions helps brands adapt to changing consumer behaviors with innovative digital solutions.</p><ul><li>Omnichannel retail experiences</li><li>Inventory management optimization</li><li>Personalized customer engagement</li><li>Supply chain visibility</li></ul></div></div></div>',
            'order' => 3,
            'is_active' => true,
        ]);

        // 4. Sub Industries Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'sub_industries',
            'title' => 'Industry Segments We Serve',
            'subtitle' => 'Sub Industries',
            'description' => 'Specialized solutions for diverse retail and CPG sectors',
            'content' => null,
            'additional_data' => json_encode([
                'items' => [
                    [
                        'title' => 'Fashion & Apparel',
                        'description' => 'End-to-end solutions for fashion brands and retailers',
                        'icon' => 'fas fa-tshirt'
                    ],
                    [
                        'title' => 'Food & Beverage',
                        'description' => 'Supply chain and distribution optimization',
                        'icon' => 'fas fa-utensils'
                    ],
                    [
                        'title' => 'Consumer Electronics',
                        'description' => 'Digital commerce and customer experience',
                        'icon' => 'fas fa-mobile-alt'
                    ],
                    [
                        'title' => 'Home & Living',
                        'description' => 'Omnichannel retail solutions',
                        'icon' => 'fas fa-home'
                    ]
                ]
            ]),
            'order' => 4,
            'is_active' => true,
        ]);

        // 5. Our Expertise Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'expertise',
            'title' => 'Our Expertise',
            'subtitle' => 'Proven Track Record',
            'description' => 'Deep domain knowledge and technical excellence',
            'content' => '<div class="container"><div class="row"><div class="col-lg-12"><h4>Technology Leadership</h4><p>HC IT Solutions brings decades of experience in retail technology, combining strategic consulting with hands-on implementation expertise.</p><ul><li>Digital Transformation Strategy</li><li>Cloud Migration & Modernization</li><li>Data Analytics & AI/ML</li><li>E-commerce Platforms</li><li>Mobile Applications</li><li>Integration Services</li></ul></div></div></div>',
            'order' => 5,
            'is_active' => true,
        ]);

        // 6. CPG Solutions Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'solutions',
            'title' => 'CPG Solutions',
            'subtitle' => 'Consumer Packaged Goods',
            'description' => 'Comprehensive solutions for CPG manufacturers and distributors',
            'content' => '<div class="container"><div class="row"><div class="col-lg-12"><p>We help CPG companies navigate the complexities of modern retail with innovative technology solutions.</p><h5>Key Capabilities:</h5><ul><li>Trade Promotion Management</li><li>Demand Planning & Forecasting</li><li>Supply Chain Optimization</li><li>Retail Execution</li><li>Consumer Analytics</li><li>DTC Commerce Platforms</li></ul></div></div></div>',
            'order' => 6,
            'is_active' => true,
        ]);

        // 7. Core Offerings Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'core_offering',
            'title' => 'Core Offerings',
            'subtitle' => 'Services & Solutions',
            'description' => 'Comprehensive services tailored to retail and CPG needs',
            'content' => null,
            'additional_data' => json_encode([
                'items' => [
                    [
                        'title' => 'Digital Commerce',
                        'description' => 'B2C and B2B e-commerce platforms that drive sales and enhance customer experience',
                        'icon' => 'fas fa-shopping-cart'
                    ],
                    [
                        'title' => 'Supply Chain Management',
                        'description' => 'End-to-end visibility and optimization across your supply chain',
                        'icon' => 'fas fa-truck'
                    ],
                    [
                        'title' => 'Customer Experience',
                        'description' => 'Omnichannel solutions that create seamless customer journeys',
                        'icon' => 'fas fa-users'
                    ],
                    [
                        'title' => 'Data & Analytics',
                        'description' => 'Advanced analytics and AI-powered insights for better decision making',
                        'icon' => 'fas fa-chart-line'
                    ]
                ]
            ]),
            'order' => 7,
            'is_active' => true,
        ]);

        // 8. Leadership Pulse Section
        IndustrySection::create([
            'industry_id' => $industry->id,
            'section_type' => 'leadership_pulse',
            'title' => 'Leadership Pulse',
            'subtitle' => 'Industry Insights',
            'description' => 'Thought leadership and insights from our retail experts',
            'content' => '<div class="container"><div class="row"><div class="col-lg-12"><p>Stay informed with the latest trends, insights, and best practices from HC IT retail industry leaders.</p><ul><li>Market Analysis & Trends</li><li>Technology Innovation</li><li>Best Practices</li><li>Customer Success Stories</li></ul></div></div></div>',
            'order' => 8,
            'is_active' => true,
        ]);

        $this->command->info('Industry sections seeded successfully for ' . $industry->title);
    }
}

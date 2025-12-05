<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutPage;
use App\Models\LeadershipMember;
use App\Models\Partner;

class AboutSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create About Pages
        AboutPage::create([
            'page_type' => 'who-we-are',
            'title' => 'Who We Are',
            'slug' => 'who-we-are',
            'description' => "Learn about HC IT's mission, vision, and values that drive our commitment to excellence.",
            'content' => '<p>HC IT is a global technology solutions provider dedicated to helping businesses transform through innovative technology. With over two decades of experience, we have established ourselves as a trusted partner for organizations seeking to leverage technology for competitive advantage.</p>',
            'meta_data' => [
                'mission' => 'To empower businesses with innovative technology solutions that drive growth and efficiency.',
                'vision' => 'To be the global leader in technology consulting and digital transformation services.',
                'values' => [
                    'Innovation' => 'We constantly push the boundaries of what\'s possible with technology.',
                    'Excellence' => 'We deliver the highest quality solutions and services to our clients.',
                    'Integrity' => 'We conduct business with honesty, transparency, and ethical practices.',
                    'Collaboration' => 'We work together with our clients and partners to achieve shared success.',
                ]
            ],
            'is_active' => true,
            'order' => 1,
        ]);

        AboutPage::create([
            'page_type' => 'our-leadership',
            'title' => 'Our Leadership',
            'slug' => 'our-leadership',
            'description' => "Meet the experienced leaders who guide HC IT's strategic direction and growth.",
            'content' => '<p>Our leadership team brings together decades of experience in technology, business strategy, and innovation. They are committed to driving HC IT\'s mission and ensuring our clients receive world-class service and solutions.</p>',
            'is_active' => true,
            'order' => 2,
        ]);

        AboutPage::create([
            'page_type' => 'our-history',
            'title' => 'Our History',
            'slug' => 'our-history',
            'description' => "Discover HC IT's journey from inception to becoming a global technology leader.",
            'content' => '<p>Founded in the early 2000s, HC IT began as a small consulting firm with a vision to help businesses harness the power of technology. Over the years, we have grown into a global organization with offices across multiple continents, serving clients in diverse industries.</p><p>Our journey has been marked by continuous innovation, strategic partnerships, and an unwavering commitment to client success. Today, we are proud to be recognized as a leader in cloud computing, digital transformation, and enterprise solutions.</p>',
            'meta_data' => [
                'milestones' => [
                    '2000' => 'HC IT founded',
                    '2005' => 'Expanded to international markets',
                    '2010' => 'Achieved Microsoft Gold Partner status',
                    '2015' => 'Launched cloud transformation practice',
                    '2020' => 'Named Microsoft\'s top cloud partner',
                    '2025' => 'Serving 500+ global clients',
                ]
            ],
            'is_active' => true,
            'order' => 3,
        ]);

        AboutPage::create([
            'page_type' => 'careers',
            'title' => 'Careers',
            'slug' => 'careers',
            'description' => 'Explore career opportunities and join our team of innovative professionals.',
            'content' => '<p>At HC IT, we believe our people are our greatest asset. We are always looking for talented, passionate individuals who want to make a difference in the world of technology.</p><p>Join us and be part of a dynamic team that values innovation, collaboration, and continuous learning. We offer competitive compensation, comprehensive benefits, and opportunities for professional growth.</p>',
            'meta_data' => [
                'benefits' => [
                    'Competitive salary and bonuses',
                    'Health and wellness programs',
                    'Professional development opportunities',
                    'Flexible work arrangements',
                    'Collaborative work environment',
                ]
            ],
            'is_active' => true,
            'order' => 4,
        ]);

        AboutPage::create([
            'page_type' => 'partners',
            'title' => 'Partners',
            'slug' => 'partners',
            'description' => 'Learn about our strategic partnerships that enhance our service offerings.',
            'content' => '<p>HC IT has established strategic partnerships with leading technology providers to deliver comprehensive solutions to our clients. These partnerships enable us to stay at the forefront of technology innovation and provide our clients with access to the latest tools and platforms.</p>',
            'is_active' => true,
            'order' => 5,
        ]);

        AboutPage::create([
            'page_type' => 'newsroom',
            'title' => 'Newsroom',
            'slug' => 'newsroom',
            'description' => 'Stay updated with the latest news, press releases, and announcements from HC IT.',
            'content' => '<p>Welcome to the HC IT Newsroom. Here you will find the latest news, press releases, awards, and announcements about our company, solutions, and partnerships.</p>',
            'is_active' => true,
            'order' => 6,
        ]);

        // Create Leadership Members
        LeadershipMember::create([
            'name' => 'John Smith',
            'title' => 'Chief Executive Officer',
            'department' => 'Executive',
            'bio' => 'John Smith is the CEO of HC IT with over 25 years of experience in technology leadership. He has led the company through significant growth and expansion into new markets.',
            'email' => 'john.smith@hcit.com',
            'linkedin_url' => 'https://linkedin.com/in/johnsmith',
            'is_active' => true,
            'order' => 1,
        ]);

        LeadershipMember::create([
            'name' => 'Sarah Johnson',
            'title' => 'Chief Technology Officer',
            'department' => 'Technology',
            'bio' => 'Sarah Johnson leads HC IT\'s technology strategy and innovation initiatives. With expertise in cloud computing and digital transformation, she drives the company\'s technical vision.',
            'email' => 'sarah.johnson@hcit.com',
            'linkedin_url' => 'https://linkedin.com/in/sarahjohnson',
            'is_active' => true,
            'order' => 2,
        ]);

        LeadershipMember::create([
            'name' => 'Michael Chen',
            'title' => 'Chief Operating Officer',
            'department' => 'Operations',
            'bio' => 'Michael Chen oversees HC IT\'s global operations, ensuring efficient delivery of services and maintaining the highest standards of quality and client satisfaction.',
            'email' => 'michael.chen@hcit.com',
            'linkedin_url' => 'https://linkedin.com/in/michaelchen',
            'is_active' => true,
            'order' => 3,
        ]);

        LeadershipMember::create([
            'name' => 'Emily Williams',
            'title' => 'Chief Financial Officer',
            'department' => 'Finance',
            'bio' => 'Emily Williams manages HC IT\'s financial strategy and operations. Her strategic financial planning has been instrumental in the company\'s sustainable growth.',
            'email' => 'emily.williams@hcit.com',
            'linkedin_url' => 'https://linkedin.com/in/emilywilliams',
            'is_active' => true,
            'order' => 4,
        ]);

        // Create Partners
        Partner::create([
            'name' => 'Microsoft',
            'slug' => 'microsoft',
            'description' => 'HC IT is Microsoft\'s top cloud partner, delivering Azure solutions and Microsoft 365 services to enterprises worldwide.',
            'website_url' => 'https://www.microsoft.com',
            'partner_type' => 'technology',
            'is_featured' => true,
            'is_active' => true,
            'order' => 1,
        ]);

        Partner::create([
            'name' => 'AWS',
            'slug' => 'aws',
            'description' => 'As an AWS Advanced Consulting Partner, HC IT helps organizations leverage Amazon Web Services for scalable cloud solutions.',
            'website_url' => 'https://aws.amazon.com',
            'partner_type' => 'technology',
            'is_featured' => true,
            'is_active' => true,
            'order' => 2,
        ]);

        Partner::create([
            'name' => 'Google Cloud',
            'slug' => 'google-cloud',
            'description' => 'HC IT is a Google Cloud Partner, providing expertise in Google Cloud Platform and Google Workspace implementations.',
            'website_url' => 'https://cloud.google.com',
            'partner_type' => 'technology',
            'is_featured' => true,
            'is_active' => true,
            'order' => 3,
        ]);

        Partner::create([
            'name' => 'Salesforce',
            'slug' => 'salesforce',
            'description' => 'HC IT is a certified Salesforce consulting partner, delivering CRM solutions and custom Salesforce implementations.',
            'website_url' => 'https://www.salesforce.com',
            'partner_type' => 'technology',
            'is_featured' => false,
            'is_active' => true,
            'order' => 4,
        ]);

        Partner::create([
            'name' => 'SAP',
            'slug' => 'sap',
            'description' => 'As an SAP partner, HC IT provides enterprise resource planning solutions and SAP implementation services.',
            'website_url' => 'https://www.sap.com',
            'partner_type' => 'technology',
            'is_featured' => false,
            'is_active' => true,
            'order' => 5,
        ]);
    }
}

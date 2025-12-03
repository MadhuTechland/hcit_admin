<?php

namespace Database\Seeders;

use App\Models\HeroSection;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    public function run(): void
    {
        HeroSection::create([
            'page' => 'home',
            'title' => 'Transforming Businesses Through Technology',
            'subtitle' => 'Enterprise Digital Solutions',
            'description' => 'Introducing cutting-edge technology into enterprises to enhance efficiency, decision-making capabilities, and overall performance.',
            'button_text' => 'Get Started',
            'button_link' => '/contact',
            'background_image' => '/assets/img/hero/home-hero.jpg',
            'status' => 'active',
            'order' => 1,
        ]);

        HeroSection::create([
            'page' => 'services',
            'title' => 'Our Services',
            'subtitle' => 'Comprehensive Digital Solutions',
            'description' => 'Tailored to your business needs',
            'button_text' => 'Contact Us',
            'button_link' => '/contact',
            'background_image' => '/assets/img/hero/services-hero.jpg',
            'status' => 'active',
            'order' => 1,
        ]);
    }
}

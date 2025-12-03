<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories
        $categoryTech = BlogCategory::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'description' => 'Latest technology trends and innovations',
        ]);

        $categoryAI = BlogCategory::create([
            'name' => 'Artificial Intelligence',
            'slug' => 'artificial-intelligence',
            'description' => 'AI and machine learning insights',
        ]);

        $categoryIntegration = BlogCategory::create([
            'name' => 'Integration',
            'slug' => 'integration',
            'description' => 'System integration and connectivity',
        ]);

        // Create tags
        $tagCloud = BlogTag::create(['name' => 'Cloud', 'slug' => 'cloud']);
        $tagGenAI = BlogTag::create(['name' => 'Generative AI', 'slug' => 'generative-ai']);
        $tagML = BlogTag::create(['name' => 'Machine Learning', 'slug' => 'machine-learning']);
        $tagDataScience = BlogTag::create(['name' => 'Data Science', 'slug' => 'data-science']);

        // Create blogs
        $blog1 = Blog::create([
            'category_id' => $categoryTech->id,
            'title' => 'Discovery incommode earnestly commanded if',
            'slug' => 'discovery-incommode-earnestly-commanded',
            'excerpt' => 'Exploring the latest technological advancements and their impact on businesses.',
            'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>',
            'featured_image' => '/assets/img/blog/1.jpg',
            'author_name' => 'John Doe',
            'status' => 'published',
            'published_at' => now()->subDays(5),
        ]);
        $blog1->tags()->attach([$tagCloud->id, $tagGenAI->id]);

        $blog2 = Blog::create([
            'category_id' => $categoryAI->id,
            'title' => 'Expression acceptance regular imprudences particular',
            'slug' => 'expression-acceptance-regular-imprudences',
            'excerpt' => 'Understanding AI implementation in modern enterprises.',
            'content' => '<p>Artificial Intelligence is transforming how businesses operate. Learn about the latest trends and best practices.</p>',
            'featured_image' => '/assets/img/blog/2.jpg',
            'author_name' => 'Jane Smith',
            'status' => 'published',
            'published_at' => now()->subDays(10),
        ]);
        $blog2->tags()->attach([$tagGenAI->id, $tagML->id]);

        $blog3 = Blog::create([
            'category_id' => $categoryIntegration->id,
            'title' => 'Considered imprudence of technical friendship',
            'slug' => 'considered-imprudence-technical-friendship',
            'excerpt' => 'System integration strategies for seamless operations.',
            'content' => '<p>Integration is key to modern business success. Discover how to connect your systems effectively.</p>',
            'featured_image' => '/assets/img/blog/3.jpg',
            'author_name' => 'Mike Johnson',
            'status' => 'published',
            'published_at' => now()->subDays(15),
        ]);
        $blog3->tags()->attach([$tagCloud->id, $tagDataScience->id]);
    }
}

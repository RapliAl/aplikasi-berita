<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SimpleDataSeeder extends Seeder
{
    public function run()
    {
        // Insert categories directly
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Latest technology news'],
            ['name' => 'Politics', 'slug' => 'politics', 'description' => 'Political news and analysis'],
            ['name' => 'Sports', 'slug' => 'sports', 'description' => 'Sports news and highlights'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business and economic news']
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insertOrIgnore([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Insert tags directly
        $tags = ['Breaking News', 'Analysis', 'Interview', 'Opinion', 'Review'];
        foreach ($tags as $tagName) {
            DB::table('tags')->insertOrIgnore([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        // Get user IDs
        $authorUser = DB::table('users')->where('email', 'author@aplikasi-berita.com')->first();
        $adminUser = DB::table('users')->where('email', 'admin@aplikasi-berita.com')->first();
        
        $authorId = $authorUser ? $authorUser->id : 1;
        $adminId = $adminUser ? $adminUser->id : 1;

        // Insert articles directly
        $articles = [
            [
                'title' => 'The Future of Artificial Intelligence in 2025',
                'slug' => 'future-artificial-intelligence-2025',
                'content' => '<p>Artificial Intelligence continues to evolve at an unprecedented pace. In this comprehensive article, we explore the latest developments in AI technology and their potential impact on various industries.</p>',
                'user_id' => $authorId,
                'category_id' => 1,
                'status' => 'published',
                'published_at' => now(),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Breaking: Major Political Reform Announced',
                'slug' => 'breaking-major-political-reform-announced',
                'content' => '<p>In a surprise announcement today, government officials revealed a comprehensive reform package aimed at boosting economic growth and addressing income inequality.</p>',
                'user_id' => $adminId,
                'category_id' => 2,
                'status' => 'published',
                'published_at' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($articles as $article) {
            DB::table('articles')->insertOrIgnore($article);
        }

        $this->command->info('Simple data seeded successfully!');
    }
}

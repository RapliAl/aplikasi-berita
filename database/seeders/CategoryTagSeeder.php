<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;

class CategoryTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            ['name' => 'Technology', 'description' => 'Latest technology news and updates'],
            ['name' => 'Politics', 'description' => 'Political news and analysis'],
            ['name' => 'Sports', 'description' => 'Sports news and highlights'],
            ['name' => 'Entertainment', 'description' => 'Entertainment and celebrity news'],
            ['name' => 'Business', 'description' => 'Business and economic news'],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['name' => $category['name']],
                [
                    'name' => $category['name'],
                    'slug' => Str::slug($category['name']),
                    'description' => $category['description'],
                ]
            );
        }

        // Create Tags
        $tags = [
            'Breaking News',
            'Analysis',
            'Interview',
            'Opinion',
            'Review',
            'Tutorial',
            'Guide',
            'Update',
            'Trending',
            'Exclusive',
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(
                ['name' => $tagName],
                [
                    'name' => $tagName,
                    'slug' => Str::slug($tagName),
                ]
            );
        }
    }
}

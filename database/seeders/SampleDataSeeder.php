<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Banner;
use App\Models\User;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Latest technology news and innovations'
            ],
            [
                'name' => 'Politics',
                'slug' => 'politics',
                'description' => 'Political news and analysis'
            ],
            [
                'name' => 'Sports',
                'slug' => 'sports',
                'description' => 'Sports news and highlights'
            ],
            [
                'name' => 'Entertainment',
                'slug' => 'entertainment',
                'description' => 'Entertainment and celebrity news'
            ],
            [
                'name' => 'Business',
                'slug' => 'business',
                'description' => 'Business and economic news'
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['name' => $categoryData['name']],
                $categoryData
            );
        }

        // Create Tags
        $tags = [
            'Breaking News', 'Analysis', 'Interview', 'Opinion', 'Review',
            'Tutorial', 'Guide', 'Update', 'Trending', 'Exclusive'
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(
                ['name' => $tagName],
                [
                    'name' => $tagName,
                    'slug' => Str::slug($tagName)
                ]
            );
        }

        // Create Sample Articles
        $author = User::where('email', 'author@aplikasi-berita.com')->first();
        $admin = User::where('email', 'admin@aplikasi-berita.com')->first();
        
        $sampleArticles = [
            [
                'title' => 'The Future of Artificial Intelligence in 2025',
                'content' => '<p>Artificial Intelligence continues to evolve at an unprecedented pace. In this comprehensive article, we explore the latest developments in AI technology and their potential impact on various industries.</p><p>From machine learning breakthroughs to ethical considerations, we cover everything you need to know about the future of AI.</p><p>The integration of AI in everyday life is becoming more seamless, with smart homes, autonomous vehicles, and intelligent personal assistants becoming commonplace.</p>',
                'category_id' => 1,
                'user_id' => $author ? $author->id : 1,
                'status' => 'published',
                'published_at' => now(),
            ],
            [
                'title' => 'Breaking: Major Political Reform Announced',
                'content' => '<p>In a surprise announcement today, government officials revealed a comprehensive reform package aimed at boosting economic growth and addressing income inequality.</p><p>The reforms include tax restructuring, infrastructure investment, and social welfare improvements.</p><p>Opposition parties have expressed mixed reactions to the proposed changes, with some calling for more detailed analysis of the potential impacts.</p>',
                'category_id' => 2,
                'user_id' => $admin ? $admin->id : 1,
                'status' => 'published',
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Championship Finals: Spectacular Performance',
                'content' => '<p>Last night\'s championship final delivered everything fans could hope for and more. The match showcased incredible skill, determination, and sportsmanship from both teams.</p><p>With a packed stadium and millions watching worldwide, the athletes rose to the occasion, delivering performances that will be remembered for years to come.</p><p>The final score was decided in the last few minutes, keeping spectators on the edge of their seats until the very end.</p>',
                'category_id' => 3,
                'user_id' => $author ? $author->id : 1,
                'status' => 'published',
                'published_at' => now()->subDays(2),
            ],
            [
                'title' => 'Movie Review: The Latest Blockbuster',
                'content' => '<p>The latest blockbuster has finally hit theaters, and it doesn\'t disappoint. With stunning visual effects, compelling storytelling, and outstanding performances, this film sets a new standard for the genre.</p><p>The director\'s vision is brought to life through exceptional cinematography and a powerful soundtrack that enhances every scene.</p><p>While some plot points may seem predictable, the overall experience is thoroughly engaging and worth the watch.</p>',
                'category_id' => 4,
                'user_id' => $admin ? $admin->id : 1,
                'status' => 'published',
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Market Analysis: Tech Stocks on the Rise',
                'content' => '<p>Recent market trends indicate a significant upturn in technology stocks, driven by innovation in AI, cloud computing, and renewable energy sectors.</p><p>Analysts suggest that companies investing in sustainable technology solutions are positioning themselves for long-term growth.</p><p>However, investors should remain cautious and diversify their portfolios to mitigate potential risks in the volatile tech market.</p>',
                'category_id' => 5,
                'user_id' => $author ? $author->id : 1,
                'status' => 'published',
                'published_at' => now()->subDays(4),
            ]
        ];

        foreach ($sampleArticles as $articleData) {
            $article = Article::firstOrCreate(
                ['title' => $articleData['title']],
                array_merge($articleData, [
                    'slug' => Str::slug($articleData['title'])
                ])
            );

            // Attach random tags to articles
            $randomTags = Tag::inRandomOrder()->limit(rand(2, 4))->pluck('id');
            $article->tags()->sync($randomTags);
        }

        // Create Sample Banners
        $banners = [
            [
                'title' => 'Welcome to Our News Portal',
                'description' => 'Stay informed with the latest news and updates from around the world.',
                'image_url' => '/storage/banners/welcome-banner.jpg',
                'link_url' => '/',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'title' => 'Subscribe to Our Newsletter',
                'description' => 'Get daily news updates delivered straight to your inbox.',
                'image_url' => '/storage/banners/newsletter-banner.jpg',
                'link_url' => '/newsletter',
                'is_active' => true,
                'sort_order' => 2
            ]
        ];

        foreach ($banners as $bannerData) {
            Banner::firstOrCreate(
                ['title' => $bannerData['title']],
                $bannerData
            );
        }

        $this->command->info('Sample data created successfully!');
    }
}

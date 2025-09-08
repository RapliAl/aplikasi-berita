@extends('frontend.layouts.app')

@section('title', 'Articles in ' . $category->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Category Header -->
    <div class="bg-white rounded-lg shadow-sm p-8 my-8">
        <div class="text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-lg text-gray-600">{{ $category->description }}</p>
            @endif
            <div class="mt-4 text-sm text-gray-500">
                {{ $articles->total() }} {{ Str::plural('article', $articles->total()) }} found
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content -->
        <div class="lg:w-2/3">
            @if($articles->count() > 0)
                <div class="grid gap-6">
                    @foreach($articles as $article)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="lg:flex">
                                <!-- Article Image Placeholder -->
                                <div class="lg:w-1/3 bg-gray-200 h-48 lg:h-auto flex items-center justify-center">
                                    @if($article->image_content)
                                        <img src="{{ Storage::url($article->image_content) }}" 
                                             alt="{{ $article->title }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="text-center text-gray-400">
                                            <svg class="mx-auto h-12 w-12 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <p class="text-sm">No Image</p>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Article Content -->
                                <div class="lg:w-2/3 p-6">
                                    <!-- Article Title -->
                                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                                        <a href="{{ route('articles.show', $article->slug) }}" 
                                           class="hover:text-indigo-600 transition-colors duration-200">
                                            {{ $article->title }}
                                        </a>
                                    </h3>
                                    
                                    <!-- Article Excerpt -->
                                    <p class="text-gray-600 mb-4 line-clamp-3">
                                        {!! Str::limit(strip_tags($article->content), 150) !!}
                                    </p>
                                    
                                    <!-- Article Meta -->
                                    <div class="flex items-center text-sm text-gray-500 mb-4">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $article->user->name }}
                                        </div>
                                        <span class="mx-2">•</span>
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ $article->published_at ? $article->published_at->format('M j, Y') : $article->created_at->format('M j, Y') }}
                                        </div>
                                    </div>
                                    
                                    <!-- Tags -->
                                    @if($article->tags->count() > 0)
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            @foreach($article->tags as $tag)
                                                @if($tag->slug)
                                                    <a href="{{ route('articles.tag', $tag->slug) }}" class="inline-block bg-gray-100 text-gray-700 hover:bg-indigo-100 hover:text-indigo-700 text-xs px-2 py-1 rounded transition-colors duration-200">
                                                        #{{ $tag->name }}
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                    
                                    <!-- Read More Button -->
                                    <a href="{{ route('articles.show', $article->slug) }}" 
                                       class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                                        Read More
                                        <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-8">
                    {{ $articles->links() }}
                </div>
            @else
                <!-- No Articles Found -->
                <div class="text-center py-12 bg-white rounded-lg shadow-sm">
                    <div class="text-gray-400 mb-4">
                        <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3v8m4-4v4m-4-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No Articles Found</h3>
                    <p class="text-gray-600">There are currently no published articles in the "{{ $category->name }}" category.</p>
                    <div class="mt-6">
                        <a href="{{ route('articles.index') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                            ← Back to All Articles
                        </a>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="lg:w-1/3">
            <!-- Back to All Categories -->
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Navigation</h3>
                <a href="{{ route('articles.index') }}" 
                   class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-medium">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd"/>
                    </svg>
                    All Categories
                </a>
            </div>

            <!-- Other Categories -->
            @if($otherCategories->count() > 0)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Other Categories</h3>
                    <ul class="space-y-2">
                        @foreach($otherCategories as $otherCategory)
                            @if($otherCategory->slug)
                                <li>
                                    <a href="{{ route('articles.category', $otherCategory->slug) }}" 
                                       class="flex items-center justify-between text-gray-600 hover:text-indigo-600 transition-colors duration-200">
                                        <span>{{ $otherCategory->name }}</span>
                                        <span class="bg-gray-100 text-gray-500 text-xs px-2 py-1 rounded-full">
                                            {{ $otherCategory->articles_count }}
                                        </span>
                                </a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

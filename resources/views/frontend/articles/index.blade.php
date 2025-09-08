@extends('frontend.layouts.app')

@section('title', 'Latest News')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 overflow-hidden">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
                <div class="text-center text-white">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                        <span class="block">Latest News From</span>
                        <span class="block bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-orange-400">
                            Berita Indonesia 
                        </span>
                    </h1>
                    <p class="text-xl md:text-2xl opacity-90 mb-8 max-w-3xl mx-auto">
                        Stay informed with the most comprehensive coverage of global events, analysis, and insights
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <div
                            class="flex items-center justify-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium">Verified Sources</span>
                        </div>
                        <div
                            class="flex items-center justify-center bg-white bg-opacity-20 backdrop-blur-sm rounded-full px-6 py-3">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="text-sm font-medium">Real-time Updates</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Decorative elements -->
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-white rounded-full animate-pulse"></div>
                <div class="absolute top-3/4 right-1/4 w-24 h-24 bg-yellow-400 rounded-full animate-pulse delay-1000"></div>
                <div class="absolute bottom-1/4 left-1/3 w-16 h-16 bg-pink-400 rounded-full animate-pulse delay-500"></div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">

            <!-- Quick Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3v8m4-4v4m-4-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Articles</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $articles->total() }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Categories</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $categories->count() }}</p>
                        </div>
                    </div>
                </div>

                <div
                    class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 transform hover:scale-105 transition-all duration-300">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Popular Tags</p>
                            <p class="text-2xl font-semibold text-gray-900">{{ $tags->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Filter Tabs -->
            <div class="mb-8">
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Browse by Category
                    </h3>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('articles.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-100 text-indigo-800 rounded-full hover:bg-indigo-200 transition-all duration-200 transform hover:scale-105 font-medium">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            All Articles
                            <span
                                class="ml-2 bg-indigo-200 text-indigo-700 text-xs px-2 py-1 rounded-full">{{ $articles->total() }}</span>
                        </a>
                        @foreach($categories as $category)
                            @if($category->slug)
                                <a href="{{ route('articles.category', $category->slug) }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-full hover:bg-blue-100 hover:text-blue-700 transition-all duration-200 transform hover:scale-105 font-medium">
                                    {{ $category->name }}
                                    <span
                                        class="ml-2 bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-full">{{ $category->articles_count ?? 0 }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Main Content -->
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-full">
                    <!-- Section Header -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                                <svg class="w-8 h-8 mr-3 text-indigo-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3v8m4-4v4m-4-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Latest Articles
                            </h2>
                            <div class="flex items-center space-x-2">
                                <span class="text-sm text-gray-500">Sort by:</span>
                                <select id="sortSelect" onchange="applySorting()"
                                    class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                                    <option value="latest" {{ request('sort') == 'latest' || !request('sort') ? 'selected' : '' }}>Latest</option>
                                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Popular</option>
                                    <option value="most_commented" {{ request('sort') == 'most_commented' ? 'selected' : '' }}>Most Commented</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 h-1 w-20 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full"></div>
                    </div>
                    <div>

                        @if($articles->count() > 0)
                            <!-- Featured Article (First Article) -->
                            @if($articles->currentPage() == 1 && $articles->count() > 0)
                                @php $featuredArticle = $articles->first(); @endphp
                                <div class="mb-12">
                                    <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                        <svg class="w-6 h-6 mr-2 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        Featured Story
                                    </h3>
                                    <article
                                        class="bg-white rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1">
                                        <div class="md:flex">
                                            <!-- Featured Image -->
                                            <div class="md:w-1/2 relative">
                                                @if($featuredArticle->image_content)
                                                    <img src="{{ Storage::url($featuredArticle->image_content) }}"
                                                        alt="{{ $featuredArticle->title }}" class="w-full h-64 md:h-full object-cover">
                                                @else
                                                    <div
                                                        class="w-full h-64 md:h-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                                                        <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3v8m4-4v4m-4-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <!-- Category Badge on Image -->
                                                @if($featuredArticle->category)
                                                    <div class="absolute top-4 left-4">
                                                        <span
                                                            class="bg-indigo-600 text-white px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                                                            {{ $featuredArticle->category->name }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Featured Content -->
                                            <div class="md:w-1/2 p-8">
                                                <h2
                                                    class="text-2xl md:text-3xl font-bold text-gray-900 mb-4 leading-tight hover:text-indigo-600 transition-colors duration-200">
                                                    <a href="{{ route('articles.show', $featuredArticle->slug) }}">
                                                        {{ $featuredArticle->title }}
                                                    </a>
                                                </h2>

                                                <p class="text-gray-600 mb-6 text-lg leading-relaxed">
                                                    {!! Str::limit(strip_tags($featuredArticle->content), 200) !!}
                                                </p>

                                                <!-- Featured Meta -->
                                                <div class="flex items-center mb-6 text-sm text-gray-500">
                                                    <div class="flex items-center mr-6">
                                                        <div
                                                            class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center mr-2">
                                                            <svg class="w-4 h-4 text-indigo-600" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                        </div>
                                                        {{ $featuredArticle->user->name }}
                                                    </div>
                                                    <div class="flex items-center">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        {{ $featuredArticle->published_at ? $featuredArticle->published_at->format('M j, Y') : $featuredArticle->created_at->format('M j, Y') }}
                                                    </div>
                                                </div>

                                                <!-- Featured Tags -->
                                                @if($featuredArticle->tags->count() > 0)
                                                    <div class="flex flex-wrap gap-2 mb-6">
                                                        @foreach($featuredArticle->tags->take(3) as $tag)
                                                            <span
                                                                class="bg-gradient-to-r from-blue-100 to-indigo-100 text-indigo-700 text-xs px-3 py-1 rounded-full font-medium">
                                                                #{{ $tag->name }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <!-- Featured CTA -->
                                                <a href="{{ route('articles.show', $featuredArticle->slug) }}"
                                                    class="inline-flex items-center bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-3 rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105 font-semibold shadow-lg">
                                                    Read Full Story
                                                    <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            @endif

                            <!-- Other Articles Grid -->
                            <div class="grid gap-8 md:grid-cols-1 m">
                                @foreach($articles->skip(1) as $article)
                                    <article
                                        class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                        <div class="lg:flex">
                                            <!-- Article Image -->
                                            <div class="lg:w-1/3 relative group">
                                                @if($article->image_content)
                                                    <img src="{{ Storage::url($article->image_content) }}" alt="{{ $article->title }}"
                                                        class="w-full h-48 lg:h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                                @else
                                                    <div
                                                        class="w-full h-48 lg:h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center group-hover:from-indigo-200 group-hover:to-purple-300 transition-all duration-300">
                                                        <svg class="w-12 h-12 text-gray-400 group-hover:text-indigo-500 transition-colors duration-300"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif

                                                <!-- Category Badge -->
                                                @if($article->category && $article->category->slug)
                                                    <div class="absolute top-3 left-3">
                                                        <a href="{{ route('articles.category', $article->category->slug) }}"
                                                            class="bg-white bg-opacity-90 backdrop-blur-sm text-indigo-700 px-3 py-1 rounded-full text-xs font-semibold shadow-lg hover:bg-indigo-100 transition-colors duration-200">
                                                            {{ $article->category->name }}
                                                        </a>
                                                    </div>
                                                @endif

                                                <!-- Reading Time Badge -->
                                                <div class="absolute bottom-3 right-3">
                                                    <div
                                                        class="bg-black bg-opacity-70 text-white px-2 py-1 rounded-full text-xs flex items-center">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Article Content -->
                                            <div class="lg:w-2/3 p-6">
                                                <!-- Article Title -->
                                                <h3
                                                    class="text-xl font-bold text-gray-900 mb-3 leading-tight hover:text-indigo-600 transition-colors duration-200">
                                                    <a href="{{ route('articles.show', $article->slug) }}" class="line-clamp-2">
                                                        {{ $article->title }}
                                                    </a>
                                                </h3>

                                                <!-- Article Excerpt -->
                                                <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                                                    {!! Str::limit(strip_tags($article->content), 150) !!}
                                                </p>

                                                <!-- Article Meta -->
                                                <div class="flex items-center justify-between mb-4">
                                                    <div class="flex items-center text-sm text-gray-500">
                                                        <div class="flex items-center mr-4">
                                                            <div
                                                                class="w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center mr-2">
                                                                <svg class="w-3 h-3 text-indigo-600" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </div>
                                                            <span class="font-medium">{{ $article->user->name }}</span>
                                                        </div>
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd"
                                                                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                                    clip-rule="evenodd" />
                                                            </svg>
                                                            {{ $article->published_at ? $article->published_at->format('M j') : $article->created_at->format('M j') }}
                                                        </div>
                                                    </div>

                                                    <!-- Engagement Stats -->
                                                    <div class="flex items-center space-x-3 text-xs text-gray-400">
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                            </svg>
                                                            {{ $article->likes->count() }}
                                                        </div>
                                                        <div class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                            </svg>
                                                            {{ $article->comments->count() }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Tags -->
                                                @if($article->tags->count() > 0)
                                                    <div class="flex flex-wrap gap-1 mb-4">
                                                        @foreach($article->tags->take(3) as $tag)
                                                            @if($tag->slug)
                                                                <a href="{{ route('articles.tag', $tag->slug) }}"
                                                                    class="bg-gray-100 text-gray-600 hover:bg-indigo-100 hover:text-indigo-700 text-xs px-2 py-1 rounded-full transition-colors duration-200">
                                                                    #{{ $tag->name }}
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                @endif

                                                <!-- Read More Button -->
                                                <a href="{{ route('articles.show', $article->slug) }}"
                                                    class="inline-flex items-center text-indigo-600 hover:text-indigo-800 font-semibold text-sm group">
                                                    Continue Reading
                                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200"
                                                        fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            <!-- Enhanced Pagination -->
                            {{-- <div class="mt-12 flex justify-center">
                                <div class="bg-white rounded-lg shadow-lg p-4">
                                    {{ $articles->links() }}
                                </div>
                            </div> --}}
                        @else
                            <!-- No Articles Found -->
                            <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3v8m4-4v4m-4-4a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-4">No Articles Found</h3>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto">There are currently no published articles
                                    available. Check back later for the latest news and updates.</p>
                                <a href="{{ route('articles.index') }}"
                                    class="inline-flex items-center bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-200 font-semibold">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Refresh Page
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Enhanced Sidebar -->
                <div class="lg:w-1/3 space-y-8 mt-12s">
                    <!-- Trending Categories -->
                    @if($categories->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 p-6">
                                <h3 class="text-xl font-bold text-white flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    Trending Categories
                                </h3>
                            </div>
                            <div class="p-6">
                                <ul class="space-y-3">
                                    @foreach($categories as $category)
                                        @if($category->slug)
                                            <li>
                                                <a href="{{ route('articles.category', $category->slug) }}"
                                                    class="group flex items-center justify-between p-3 rounded-lg hover:bg-gradient-to-r hover:from-indigo-50 hover:to-purple-50 transition-all duration-200">
                                                    <div class="flex items-center">
                                                        <div
                                                            class="w-10 h-10 bg-gradient-to-br from-indigo-100 to-purple-100 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition-transform duration-200">
                                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <span
                                                            class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">{{ $category->name }}</span>
                                                        @if($category->description)
                                                            <p class="text-xs text-gray-500 mt-1">
                                                                {{ Str::limit($category->description, 30) }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex items-center">
                                                    <span
                                                        class="bg-indigo-100 text-indigo-600 text-xs font-semibold px-2 py-1 rounded-full mr-2">
                                                        {{ $category->articles_count ?? 0 }}
                                                    </span>
                                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-indigo-600 group-hover:translate-x-1 transition-all duration-200"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </div>
                                            </a>
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Popular Tags Cloud -->
                    @if($tags->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                            <div class="bg-gradient-to-r from-green-600 to-blue-600 p-6">
                                <h3 class="text-xl font-bold text-white flex items-center">
                                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                    Popular Tags
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="flex flex-wrap gap-3">
                                    @foreach($tags->take(10) as $tag)
                                        @if($tag->slug)
                                            <a href="{{ route('articles.tag', $tag->slug) }}"
                                                class="group inline-flex items-center bg-gradient-to-r from-gray-100 to-gray-200 hover:from-blue-100 hover:to-indigo-200 text-gray-700 hover:text-indigo-700 px-4 py-2 rounded-full transition-all duration-200 transform hover:scale-105 hover:shadow-md">
                                                <svg class="w-3 h-3 mr-1 group-hover:rotate-12 transition-transform duration-200"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            <span class="font-medium text-sm">{{ $tag->name }}</span>
                                            <span
                                                class="ml-2 bg-white bg-opacity-70 text-xs px-2 py-1 rounded-full">{{ $tag->articles_count ?? 0 }}</span>
                                        </a>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Newsletter Signup -->
                    <div
                        class="bg-gradient-to-br from-yellow-400 via-orange-500 to-red-500 rounded-2xl shadow-lg overflow-hidden">
                        <div class="p-8 text-white">
                            <div class="text-center">
                                <div
                                    class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Stay Updated!</h3>
                                <p class="text-sm opacity-90 mb-6">Get the latest news delivered directly to your inbox</p>
                                <form class="space-y-3">
                                    <input type="email" placeholder="Enter your email"
                                        class="w-full px-4 py-3 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50">
                                    <button type="submit"
                                        class="w-full bg-white text-orange-600 font-semibold py-3 px-4 rounded-lg hover:bg-gray-100 transition-colors duration-200 transform hover:scale-105">
                                        Subscribe Now
                                    </button>
                                </form>
                                <p class="text-xs opacity-75 mt-3">No spam, unsubscribe anytime</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    {{-- <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            Quick Links
                        </h3>
                        <ul class="space-y-3">
                            <li><a href="#"
                                    class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200 group">
                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    About Us
                                </a></li>
                            <li><a href="#"
                                    class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200 group">
                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Contact
                                </a></li>
                            <li><a href="#"
                                    class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200 group">
                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Privacy Policy
                                </a></li>
                            <li><a href="#"
                                    class="flex items-center text-gray-600 hover:text-indigo-600 transition-colors duration-200 group">
                                    <svg class="w-4 h-4 mr-2 group-hover:scale-110 transition-transform duration-200"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                    Terms of Service
                                </a></li>
                        </ul>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- Enhanced Custom Styles -->
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom gradient animations */
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-gradient {
            background-size: 200% 200%;
            animation: gradient 6s ease infinite;
        }

        /* Hover effects for cards */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        /* Custom scrollbar for sidebar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #6366f1, #8b5cf6);
            border-radius: 10px;
        }

        /* Loading skeleton animation */
        @keyframes shimmer {
            0% {
                background-position: -200px 0;
            }

            100% {
                background-position: calc(200px + 100%) 0;
            }
        }

        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200px 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>

    <!-- Optional: Add some JavaScript for enhanced interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Add smooth scroll to top button
            const scrollBtn = document.createElement('button');
            scrollBtn.innerHTML = `
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                </svg>
            `;
            scrollBtn.className = 'fixed bottom-8 right-8 bg-indigo-600 text-white p-3 rounded-full shadow-lg hover:bg-indigo-700 transition-all duration-300 transform hover:scale-110 z-50 opacity-0';
            scrollBtn.onclick = () => window.scrollTo({ top: 0, behavior: 'smooth' });
            document.body.appendChild(scrollBtn);

            // Show/hide scroll button
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    scrollBtn.classList.remove('opacity-0');
                    scrollBtn.classList.add('opacity-100');
                } else {
                    scrollBtn.classList.remove('opacity-100');
                    scrollBtn.classList.add('opacity-0');
                }
            });

            // Add reading progress bar
            const progressBar = document.createElement('div');
            progressBar.className = 'fixed top-0 left-0 h-1 bg-gradient-to-r from-indigo-600 to-purple-600 transition-all duration-150 z-50';
            progressBar.style.width = '0%';
            document.body.appendChild(progressBar);

            window.addEventListener('scroll', () => {
                const scrollPercent = (window.pageYOffset / (document.body.scrollHeight - window.innerHeight)) * 100;
                progressBar.style.width = scrollPercent + '%';
            });
        });

        // Function to handle sorting
        function applySorting() {
            const sortValue = document.getElementById('sortSelect').value;
            const url = new URL(window.location.href);
            url.searchParams.set('sort', sortValue);
            url.searchParams.delete('page'); // Reset to first page when sorting
            window.location.href = url.toString();
        }
    </script>
@endsection
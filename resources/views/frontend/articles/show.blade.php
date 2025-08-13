@extends('frontend.layouts.app')

@section('title', $article->title)
@section('meta_description', Str::limit(strip_tags($article->content), 155))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-50">
    <!-- Article Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-900 via-purple-800 to-indigo-900 overflow-hidden">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
            <!-- Breadcrumb -->
            <nav class="mb-8" aria-label="Breadcrumb">
                <div class="flex items-center space-x-2 text-sm text-blue-100/80">
                    <a href="{{ route('articles.index') }}" class="hover:text-white transition-colors duration-200">
                        <svg class="w-4 h-4 mr-1 inline" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-3a1 1 0 011-1h2a1 1 0 011 1v3a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Beranda
                    </a>
                    <span class="text-blue-200">/</span>
                    <a href="{{ route('articles.index') }}" class="hover:text-white transition-colors duration-200">Artikel</a>
                    @if($article->category)
                        <span class="text-blue-200">/</span>
                        <a href="{{ route('articles.index', ['category' => $article->category->slug]) }}" 
                           class="hover:text-white transition-colors duration-200">
                            {{ $article->category->name }}
                        </a>
                    @endif
                </div>
            </nav>

            <!-- Article Header -->
            <div class="max-w-4xl">
                <!-- Category Badge -->
                @if($article->category)
                    <div class="mb-6">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-500 to-purple-600 text-white shadow-lg">
                            {{ $article->category->name }}
                        </span>
                    </div>
                @endif

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ $article->title }}
                </h1>

                <!-- Meta Information -->
                <div class="flex flex-wrap items-center gap-6 text-blue-100/90 mb-8">
                    <!-- Author -->
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-semibold text-sm">
                                {{ substr($article->user->name, 0, 2) }}
                            </span>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-white">{{ $article->user->name }}</p>
                            <p class="text-xs text-blue-200">Penulis</p>
                        </div>
                    </div>

                    <!-- Date -->
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span class="text-sm">{{ $article->created_at->format('d M Y') }}</span>
                    </div>

                    <!-- Reading Time -->
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-sm">{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} menit baca</span>
                    </div>

                    <!-- Views (if available) -->
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span class="text-sm">{{ number_format(rand(50, 500)) }} views</span>
                    </div>
                </div>

                <!-- Tags -->
                @if($article->tags->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-white/20 text-white backdrop-blur-sm border border-white/30">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Article Content -->
            <article class="lg:col-span-2">
                <!-- Featured Image (if exists) -->
                @if($article->image_content)
                    <div class="mb-8 rounded-2xl overflow-hidden shadow-2xl">
                        <img src="{{ Storage::url($article->image_content) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-96 object-cover">
                    </div>
                @endif

                <!-- Content -->
                <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12 mb-8">
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed">
                            {!! $article->content !!}
                        </div>
                    </div>
                </div>

                <!-- Social Share & Like -->
                <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <!-- Like Button -->
                            <form id="like-form" action="{{ route('articles.like', $article) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit" 
                                        class="flex items-center gap-2 px-4 py-2 rounded-full transition-all duration-200 hover:scale-105 
                                               {{ auth()->check() && $article->isLikedBy(Auth::user()) 
                                                  ? 'bg-gradient-to-r from-red-500 to-pink-500 text-white shadow-lg' 
                                                  : 'bg-gray-100 text-gray-600 hover:bg-gradient-to-r hover:from-red-500 hover:to-pink-500 hover:text-white hover:shadow-lg' }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="font-medium" id="like-count">{{ $article->likes->count() }}</span>
                                </button>
                            </form>

                            <!-- Comments Count -->
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <span class="font-medium">{{ $article->comments->count() }}</span>
                            </div>
                        </div>

                        <!-- Social Share -->
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-500 font-medium">Bagikan:</span>
                            
                            <!-- WhatsApp -->
                            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->fullUrl()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-2.462-.96-4.773-2.7-6.514-1.74-1.741-4.054-2.705-6.517-2.707-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.11-.981.968.329z"/>
                                </svg>
                            </a>

                            <!-- Twitter -->
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-gradient-to-r from-blue-400 to-blue-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>

                            <!-- Facebook -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank"
                               class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 shadow-lg">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>

                            <!-- Copy Link -->
                            <button onclick="copyToClipboard('{{ request()->fullUrl() }}')"
                                    class="w-10 h-10 bg-gradient-to-r from-gray-500 to-gray-600 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-200 shadow-lg">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        Komentar ({{ $article->comments->count() }})
                    </h2>

                    @auth
                        <!-- Comment Form -->
                        <form action="{{ route('articles.comments.store', $article) }}" method="POST" class="mb-8">
                            @csrf
                            
                            <div class="flex gap-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold">
                                            {{ substr(auth()->user()->name, 0, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <textarea name="content" 
                                              rows="4" 
                                              placeholder="Tulis komentar Anda..."
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"></textarea>
                                    @error('content')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    
                                    <div class="flex justify-end mt-3">
                                        <button type="submit" 
                                                class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-200 font-medium shadow-lg hover:shadow-xl">
                                            Kirim Komentar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="mb-8 p-6 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-200">
                            <p class="text-gray-700 text-center">
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">Masuk</a> 
                                atau 
                                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">daftar</a> 
                                untuk memberikan komentar.
                            </p>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse($article->comments()->with('user')->latest()->get() as $comment)
                            <div class="flex gap-4 p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 bg-gradient-to-r from-green-400 to-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">
                                            {{ substr($comment->user->name, 0, 2) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <h4 class="font-medium text-gray-900">{{ $comment->user->name }}</h4>
                                        <span class="text-sm text-gray-500">•</span>
                                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">{{ $comment->content }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama untuk berkomentar!</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Related Articles -->
                @php
                    $relatedArticles = App\Models\Article::where('id', '!=', $article->id)
                        ->when($article->category_id, function($query) use ($article) {
                            return $query->where('category_id', $article->category_id);
                        })
                        ->latest()
                        ->limit(5)
                        ->get();
                @endphp

                @if($relatedArticles->count() > 0)
                    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                            Artikel Terkait
                        </h3>
                        <div class="space-y-4">
                            @foreach($relatedArticles as $related)
                                <article class="group">
                                    <a href="{{ route('articles.show', $related->slug) }}" 
                                       class="flex gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors duration-200">
                                        @if($related->image_content)
                                            <div class="flex-shrink-0 w-16 h-16 bg-gray-200 rounded-lg overflow-hidden">
                                                <img src="{{ Storage::url($related->image_content) }}" 
                                                     alt="{{ $related->title }}" 
                                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200">
                                            </div>
                                        @else
                                            <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-lg flex items-center justify-center">
                                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-medium text-gray-900 text-sm leading-tight mb-1 group-hover:text-blue-600 transition-colors duration-200">
                                                {{ Str::limit($related->title, 60) }}
                                            </h4>
                                            <p class="text-xs text-gray-500">{{ $related->created_at->format('d M Y') }}</p>
                                        </div>
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Popular Categories -->
                @php
                    $popularCategories = App\Models\Category::withCount('articles')
                        ->having('articles_count', '>', 0)
                        ->orderBy('articles_count', 'desc')
                        ->limit(6)
                        ->get();
                @endphp

                @if($popularCategories->count() > 0)
                    <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Kategori Populer
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($popularCategories as $category)
                                <a href="{{ route('articles.index', ['category' => $category->slug]) }}" 
                                   class="inline-flex items-center px-3 py-2 rounded-full text-sm font-medium bg-gradient-to-r from-blue-50 to-purple-50 text-blue-700 hover:from-blue-100 hover:to-purple-100 transition-all duration-200 border border-blue-200 hover:border-blue-300">
                                    {{ $category->name }}
                                    <span class="ml-1 text-xs text-blue-500">({{ $category->articles_count }})</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Newsletter -->
                <div class="bg-gradient-to-br from-blue-600 via-purple-600 to-indigo-700 rounded-2xl shadow-xl p-6 text-white">
                    <div class="text-center">
                        <svg class="w-12 h-12 text-blue-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <h3 class="text-xl font-bold mb-2">Berlangganan Newsletter</h3>
                        <p class="text-blue-100 text-sm mb-4">Dapatkan artikel terbaru langsung di email Anda</p>
                        
                        <form class="space-y-3">
                            <input type="email" 
                                   placeholder="Email Anda"
                                   class="w-full px-4 py-3 rounded-xl border-0 bg-white/20 text-white placeholder-blue-200 focus:ring-2 focus:ring-white/50 focus:bg-white/30 transition-all duration-200 backdrop-blur-sm">
                            <button type="submit" 
                                    class="w-full bg-white text-blue-600 py-3 rounded-xl font-medium hover:bg-blue-50 transition-colors duration-200 shadow-lg">
                                Berlangganan
                            </button>
                        </form>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- AJAX for Like functionality -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const likeForm = document.getElementById('like-form');
    
    if (likeForm) {
        likeForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const likeCount = document.getElementById('like-count');
                    const button = this.querySelector('button');
                    
                    likeCount.textContent = data.likes_count;
                    
                    if (data.liked) {
                        button.classList.add('bg-gradient-to-r', 'from-red-500', 'to-pink-500', 'text-white', 'shadow-lg');
                        button.classList.remove('bg-gray-100', 'text-gray-600');
                    } else {
                        button.classList.remove('bg-gradient-to-r', 'from-red-500', 'to-pink-500', 'text-white', 'shadow-lg');
                        button.classList.add('bg-gray-100', 'text-gray-600');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show a temporary notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50';
        notification.textContent = 'Link berhasil disalin!';
        document.body.appendChild(notification);
        
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 3000);
    });
}
</script>
@endsection

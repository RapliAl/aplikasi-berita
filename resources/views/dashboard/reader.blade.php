@extends('dashboard.layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Simple Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Selamat datang, {{ auth()->user()->name }}</h1>
                    <p class="text-gray-600 mt-1">Temukan artikel menarik untuk dibaca hari ini</p>
                </div>
                <div class="text-right">
                    <div class="text-sm text-gray-500">{{ now()->format('l, d M Y') }}</div>
                    <div class="text-xs text-gray-400 mt-1">{{ now()->format('H:i') }} WIB</div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Simple Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-blue-50 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Artikel Dibaca</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['articles_read'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-green-50 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Komentar</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['comments_made'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-c">
                    <div class="p-3 bg-red-50 rounded-lg">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Artikel Dilike</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['articles_liked'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg p-6 border border-gray-200 hover:shadow-lg transition-shadow duration-200">
                <div class="flex items-center">
                    <div class="p-3 bg-yellow-50 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Reading Streak</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $userStats['reading_streak'] ?? 0 }}</p>
                        <p class="text-xs text-gray-500">hari berturut-turut</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Artikel Rekomendasi -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Artikel Rekomendasi</h2>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            Lihat Semua →
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($recommendedArticles ?? [] as $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="block group border border-gray-100 rounded-lg p-4 hover:bg-gray-50 transition-colors duration-200 cursor-pointer">
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <span class="text-white font-semibold text-sm">{{ substr($article->title, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-medium text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                        {{ Str::limit($article->title, 70) }}
                                    </h3>
                                    <p class="text-sm text-gray-600 mb-3 leading-relaxed">
                                        {{ Str::limit(strip_tags($article->content), 120) }}
                                    </p>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <span>{{ $article->user->name }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $article->created_at->diffForHumans() }}</span>
                                        @if($article->category)
                                        <span class="mx-2">•</span>
                                        <span class="text-blue-600">{{ $article->category->name }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-12">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 mb-4">Belum ada artikel tersedia</p>
                            <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                Jelajahi Artikel
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Kategori Favorit -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Kategori Favorit</h3>
                    <div class="space-y-3">
                        @forelse($favoriteCategories ?? [] as $category)
                        <div class="flex items-center justify-between py-2">
                            <span class="text-gray-700">{{ $category->name }}</span>
                            <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">{{ $category->articles_count ?? 0 }}</span>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4 text-sm">Belum ada kategori favorit</p>
                        @endforelse
                    </div>
                </div>

                <!-- Artikel Trending -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Trending Artikel</h3>
                    <div class="space-y-3">
                        @forelse($trendingArticles ?? [] as $index => $article)
                        <div class="flex items-start space-x-3 py-2">
                            <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-semibold">
                                {{ $index + 1 }}
                            </span>
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-medium text-gray-900 mb-1">{{ Str::limit($article->title, 50) }}</h4>
                                <p class="text-xs text-gray-500">{{ $article->user->name }} • {{ $article->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-4 text-sm">Tidak ada artikel trending</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="{{ route('home') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            </svg>
                            <span class="text-gray-700 font-medium">Jelajahi Artikel</span>
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-gray-700 font-medium">Edit Profil</span>
                        </a>
                        
                        <a href="#" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-700 font-medium">Pengaturan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-8">
            <div class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Aktivitas Terbaru</h3>
                <div class="space-y-3">
                    @forelse($recentComments ?? [] as $comment)
                    <div class="flex items-start space-x-3 py-2">
                        <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm text-gray-900">Anda berkomentar: "{{ Str::limit($comment->content, 60) }}"</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-6">
                        <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 text-sm">Belum ada aktivitas terbaru</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Artikel yang Sudah Dibaca dan Dilike -->
        @if($userStats['articles_read'] > 0 || $userStats['articles_liked'] > 0)
        <div class="mt-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Artikel yang Sudah Dibaca -->
                @if($userStats['articles_read'] > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Artikel yang Sudah Dibaca</h2>
                        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                            {{ $userStats['articles_read'] }} artikel
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        @php
                            $readArticles = auth()->user()->viewedArticles()
                                ->with(['user', 'category'])
                                ->latest('article_views.viewed_at')
                                ->take(5)
                                ->get();
                        @endphp
                        
                        @forelse($readArticles as $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">{{ $article->title }}</h4>
                                    <p class="text-xs text-gray-500">
                                        Dibaca {{ $article->pivot->viewed_at ? \Carbon\Carbon::parse($article->pivot->viewed_at)->diffForHumans() : 'baru saja' }}
                                    </p>
                                    @if($article->category)
                                    <span class="inline-block mt-2 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">
                                        {{ $article->category->name }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center text-gray-500 py-8">
                            <p>Belum ada artikel yang dibaca</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endif

                <!-- Artikel yang Dilike -->
                @if($userStats['articles_liked'] > 0)
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">Artikel yang Dilike</h2>
                        <span class="bg-red-100 text-red-800 text-sm font-medium px-3 py-1 rounded-full">
                            {{ $userStats['articles_liked'] }} artikel
                        </span>
                    </div>
                    
                    <div class="space-y-4">
                        @php
                            $likedArticles = auth()->user()->likedArticles()
                                ->with(['user', 'category'])
                                ->latest('likes.created_at')
                                ->take(5)
                                ->get();
                        @endphp
                        
                        @forelse($likedArticles as $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="block">
                            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">{{ $article->title }}</h4>
                                    <p class="text-xs text-gray-500">
                                        Dilike {{ $article->pivot->created_at ? $article->pivot->created_at->diffForHumans() : 'baru saja' }}
                                    </p>
                                    @if($article->category)
                                    <span class="inline-block mt-2 bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                        {{ $article->category->name }}
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="text-center text-gray-500 py-8">
                            <p>Belum ada artikel yang dilike</p>
                        </div>
                        @endforelse
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Simple hover effects */
.hover\:shadow-lg:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
}

/* Smooth transitions */
* {
    transition: all 0.2s ease;
}

/* Focus states for accessibility */
button:focus, a:focus {
    outline: 2px solid #3B82F6;
    outline-offset: 2px;
}
</style>
@endsection

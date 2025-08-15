@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Welcome Header -->
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 mb-8 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <p class="text-blue-100 text-lg">Jelajahi artikel terbaru dan tetap terinformasi</p>
                </div>
                <div class="hidden md:block">
                    <div class="bg-white bg-opacity-20 backdrop-blur-sm rounded-xl p-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold">{{ now()->format('d') }}</div>
                            <div class="text-sm">{{ now()->format('M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Artikel Dibaca</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $userStats['articles_read'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-green-100 rounded-lg">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Komentar</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $userStats['comments_made'] }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="flex items-center">
                            <div class="p-3 bg-purple-100 rounded-lg">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-600">Streak Hari</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $userStats['reading_streak'] ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recommended Articles -->
                <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Artikel Rekomendasi</h2>
                        <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                            Lihat Semua
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse($recommendedArticles as $article)
                        <article class="group cursor-pointer">
                            <div class="bg-gray-50 rounded-lg p-6 h-full border border-gray-100 hover:border-blue-200 hover:shadow-md transition-all duration-200">
                                <div class="flex items-start space-x-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                            <span class="text-white font-semibold text-lg">{{ substr($article->title, 0, 1) }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 mb-2">
                                            {{ Str::limit($article->title, 60) }}
                                        </h3>
                                        <p class="text-sm text-gray-600 mb-3">
                                            {{ Str::limit(strip_tags($article->content), 100) }}
                                        </p>
                                        <div class="flex items-center justify-between text-sm text-gray-500">
                                            <span>{{ $article->user->name }}</span>
                                            <span>{{ $article->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        @empty
                        <div class="col-span-2 text-center py-8">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500">Belum ada artikel tersedia</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Favorite Categories -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Kategori Favorit</h3>
                    @forelse($favoriteCategories as $category)
                    <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                        <span class="text-gray-700">{{ $category->name }}</span>
                        <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded-full text-sm">{{ $category->articles_count }}</span>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-4">Belum ada kategori favorit</p>
                    @endforelse
                </div>

                <!-- Trending Articles -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Artikel Trending</h3>
                    @forelse($trendingArticles as $index => $article)
                    <div class="flex items-start space-x-3 py-3 border-b border-gray-100 last:border-b-0">
                        <span class="flex-shrink-0 w-6 h-6 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-sm font-semibold">
                            {{ $index + 1 }}
                        </span>
                        <div>
                            <h4 class="font-medium text-gray-900 text-sm mb-1">{{ Str::limit($article->title, 50) }}</h4>
                            <p class="text-xs text-gray-500">{{ $article->user->name }} • {{ $article->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-4">Tidak ada artikel trending</p>
                    @endforelse
                </div>

                <!-- Recent Comments -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Komentar Terbaru</h3>
                    @forelse($recentComments->take(5) as $comment)
                    <div class="py-3 border-b border-gray-100 last:border-b-0">
                        <p class="text-sm text-gray-700 mb-1">{{ Str::limit($comment->content, 60) }}</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>{{ $comment->user->name }}</span>
                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-4">Belum ada komentar</p>
                    @endforelse
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('home') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                            </svg>
                            <span class="text-gray-700">Jelajahi Artikel</span>
                        </a>
                        
                        <a href="#" class="flex items-center p-3 bg-green-50 hover:bg-green-100 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="text-gray-700">Edit Profil</span>
                        </a>
                        
                        <a href="#" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-gray-700">Pengaturan</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

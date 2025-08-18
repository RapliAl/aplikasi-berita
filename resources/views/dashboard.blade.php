<x-app-layout>
    <!-- Custom Styles -->
    <style>
        /* Blob Animation */
        @keyframes blob {
            0% { transform: translate(0px, 0px) scale(1); }
            33% { transform: translate(30px, -50px) scale(1.1); }
            66% { transform: translate(-20px, 20px) scale(0.9); }
            100% { transform: translate(0px, 0px) scale(1); }
        }

        .animate-blob { animation: blob 7s infinite; }
        .animation-delay-2000 { animation-delay: 2s; }
        .animation-delay-4000 { animation-delay: 4s; }

        /* Float Animation */
        @keyframes float {
            0% { transform: translatey(0px); }
            50% { transform: translatey(-10px); }
            100% { transform: translatey(0px); }
        }

        .animate-float { animation: float 3s ease-in-out infinite; }

        /* Progress Animation */
        @keyframes progress {
            0% { width: 0%; }
            100% { width: var(--progress-width); }
        }

        .animate-progress { animation: progress 1.5s ease-out forwards; }

        /* Card Hover */
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Glass Effect */
        .glass {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            to { opacity: 1; }
        }
    </style>
    
    <x-slot name="header">
        <div>
            <!-- Animated background -->
            {{-- <div class="absolute inset-0 opacity-20">
                <div class="absolute top-0 left-0 w-40 h-40 bg-white rounded-full mix-blend-multiply filter blur-xl animate-blob"></div>
                <div class="absolute top-0 right-0 w-40 h-40 bg-yellow-300 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-8 left-20 w-40 h-40 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-blob animation-delay-4000"></div>
            </div> --}}
            
            <div class="relative flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-3xl text-white leading-tight mb-2 animate-float">
                        <span class="inline-block animate-bounce"></span> 
                        Selamat Datang, <span class="text-yellow-300">{{ Auth::user()->name }}</span>!
                    </h2>
                    <p class="text-blue-100 text-lg">
                        {{ __('Kelola konten dan pantau aktivitas Anda di sini') }}
                    </p>
                </div>
                <div class="hidden md:block">
                    <div class="glass rounded-2xl p-4 border border-white/30">
                        <div class="text-white text-center">
                            <div class="text-2xl font-bold">{{ now()->format('d') }}</div>
                            <div class="text-sm">{{ now()->format('M Y') }}</div>
                            <div class="text-xs opacity-75 mt-1">{{ now()->format('l') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Articles Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-xl card-hover cursor-pointer group relative overflow-hidden">
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm font-medium opacity-90 mb-1">Artikel Anda</p>
                            <p class="text-3xl font-bold">{{ Auth::user()->articles()->count() }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Published Articles -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-xl card-hover cursor-pointer group relative overflow-hidden">
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm font-medium opacity-90 mb-1">Dipublikasikan</p>
                            <p class="text-3xl font-bold">{{ Auth::user()->articles()->where('status', 'published')->count() }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Comments -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white shadow-xl card-hover cursor-pointer group relative overflow-hidden">
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm font-medium opacity-90 mb-1">Komentar</p>
                            <p class="text-3xl font-bold">{{ Auth::user()->comments()->count() }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <!-- Likes -->
                <div class="bg-gradient-to-br from-red-500 to-pink-600 rounded-2xl p-6 text-white shadow-xl card-hover cursor-pointer group relative overflow-hidden">
                    <div class="flex items-center justify-between relative z-10">
                        <div>
                            <p class="text-sm font-medium opacity-90 mb-1">Likes</p>
                            <p class="text-3xl font-bold">{{ Auth::user()->likes()->count() }}</p>
                        </div>
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-br from-white/5 to-transparent rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Articles -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 card-hover">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-800 flex items-center">
                                <span class="mr-2 animate-bounce">📝</span> Artikel Terbaru Anda
                            </h3>
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center group">
                                Lihat Semua
                                <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="space-y-4 max-h-96 overflow-y-auto">
                            @forelse(Auth::user()->articles()->with(['category'])->withCount(['comments', 'likes'])->latest()->take(5)->get() as $index => $article)
                                <div class="fade-in relative bg-gray-50 rounded-xl hover:bg-gray-100 transition-all duration-200 group hover:shadow-lg border border-transparent hover:border-blue-200" style="animation-delay: {{ $index * 100 }}ms">
                                    <!-- Main clickable area -->
                                    <a href="{{ route('articles.show', $article->slug) }}" class="flex items-center p-4 block w-full">
                                        <div class="flex-shrink-0 w-16 h-16 bg-gradient-to-br from-blue-400 to-purple-500 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-200 relative">
                                            @if($article->featured_image)
                                                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover rounded-xl">
                                            @else
                                                <span class="text-white font-bold text-lg">{{ substr($article->title, 0, 1) }}</span>
                                            @endif
                                            
                                            <!-- Status indicator -->
                                            <div class="absolute -top-1 -right-1 w-3 h-3 rounded-full {{ $article->status === 'published' ? 'bg-green-500' : ($article->status === 'draft' ? 'bg-yellow-500' : 'bg-gray-500') }} border-2 border-white"></div>
                                        </div>
                                        
                                        <div class="ml-4 flex-grow">
                                            <h4 class="font-semibold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2">
                                                {{ $article->title }}
                                            </h4>
                                            
                                            <!-- Excerpt -->
                                            @if($article->excerpt || $article->content)
                                                <p class="text-xs text-gray-600 mb-2 line-clamp-1 group-hover:text-gray-800 transition-colors duration-200">
                                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 80) }}
                                                </p>
                                            @endif
                                            
                                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                                <span class="flex items-center">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $article->created_at->format('d M Y') }}
                                                </span>
                                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ $article->status === 'published' ? 'bg-green-100 text-green-800' : ($article->status === 'draft' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                                    {{ ucfirst($article->status) }}
                                                </span>
                                                @if(isset($article->category) && $article->category)
                                                    <span class="text-blue-600 text-xs font-medium bg-blue-50 px-2 py-1 rounded-full">{{ $article->category->name }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-3 ml-4">
                                            <div class="text-center">
                                                <div class="text-gray-600 font-semibold text-sm">{{ $article->comments_count ?? 0 }}</div>
                                                <div class="text-gray-400 text-xs">💬</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-gray-600 font-semibold text-sm">{{ $article->likes_count ?? 0 }}</div>
                                                <div class="text-gray-400 text-xs">❤️</div>
                                            </div>
                                            
                                            <!-- View count (simulated) -->
                                            <div class="text-center">
                                                <div class="text-gray-600 font-semibold text-sm">{{ rand(10, 100) }}</div>
                                                <div class="text-gray-400 text-xs">👁️</div>
                                            </div>
                                        </div>
                                    </a>
                                    
                                    <!-- Action buttons (hover overlay) -->
                                    <div class="absolute top-2 right-2 flex space-x-1 opacity-0 group-hover:opacity-100 transition-all duration-200">
                                        @if($article->status === 'published')
                                            <a href="{{ route('articles.show', $article->slug) }}" target="_blank" class="p-1.5 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors duration-200 text-xs" title="Lihat artikel">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                                </svg>
                                            </a>
                                        @endif
                                        
                                        <button onclick="shareArticle('{{ $article->title }}', '{{ route('articles.show', $article->slug) }}')" class="p-1.5 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-200 text-xs" title="Share artikel">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                            </svg>
                                        </button>
                                        
                                        {{-- <span class="px-2 py-1 bg-gray-800 text-white text-xs rounded-lg font-medium">
                                            {{ $article->status === 'published' ? 'Live' : ucfirst($article->status) }}
                                        </span> --}}
                                    </div>
                                    
                                    <!-- Reading time estimate -->
                                    <div class="absolute bottom-2 left-20 opacity-0 group-hover:opacity-100 transition-all duration-200">
                                        <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-md shadow-sm">
                                            ⏱️ {{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Artikel</h4>
                                    <p class="text-gray-500 mb-4">Mulai menulis artikel pertama Anda dan bagikan ide-ide menarik!</p>
                                    <a href="#" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transform hover:scale-105 transition-all duration-200 shadow-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                        Buat Artikel Pertama
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Quick Actions -->
                    {{-- <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 card-hover">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="mr-2 animate-pulse">⚡</span> Aksi Cepat
                        </h3>
                        <div class="space-y-3">
                            <a href="#" class="flex items-center p-3 bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl hover:from-blue-100 hover:to-blue-200 transition-all duration-200 group border border-blue-200">
                                <div class="flex-shrink-0 w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 font-medium text-gray-800">Tulis Artikel Baru</span>
                            </a>

                            <a href="#" class="flex items-center p-3 bg-gradient-to-r from-green-50 to-green-100 rounded-xl hover:from-green-100 hover:to-green-200 transition-all duration-200 group border border-green-200">
                                <div class="flex-shrink-0 w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 font-medium text-gray-800">Edit Profil</span>
                            </a>

                            <a href="#" class="flex items-center p-3 bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl hover:from-purple-100 hover:to-purple-200 transition-all duration-200 group border border-purple-200">
                                <div class="flex-shrink-0 w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <span class="ml-3 font-medium text-gray-800">Lihat Statistik</span>
                            </a>
                        </div>
                    </div> --}}

                    <!-- Activity Feed -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 card-hover">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="mr-2">📈</span> Aktivitas Terbaru
                        </h3>
                        <div class="space-y-4">
                            @php
                            $recentArticles = Auth::user()->articles()->latest()->take(3)->get();
                            @endphp
                            
                            @forelse($recentArticles as $article)
                                <div class="flex items-start space-x-3 group">
                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-800 group-hover:text-gray-900 transition-colors duration-200">Artikel "{{ Str::limit($article->title, 30) }}" dibuat</p>
                                        <p class="text-xs text-gray-500 group-hover:text-gray-600 transition-colors duration-200">{{ $article->created_at->diffForHumans() }}</p>
                                    </div>
                                    <div class="w-2 h-2 bg-blue-400 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
                                </div>
                            @empty
                                <div class="flex items-start space-x-3 group">
                                    <div class="flex-shrink-0 w-8 h-8 bg-gray-100 text-gray-600 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-grow">
                                        <p class="text-sm text-gray-800">Mulai dengan membuat artikel pertama Anda</p>
                                        <p class="text-xs text-gray-500">Sekarang</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Performance Overview -->
                    <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-2xl shadow-xl p-6 border border-indigo-100 card-hover">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="mr-2">🎯</span> Performa Minggu Ini
                        </h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Artikel Dilihat</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-blue-600 h-2 rounded-full animate-progress" style="--progress-width: 75%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-800">{{ rand(100, 500) }}</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Engagement</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-green-600 h-2 rounded-full animate-progress" style="--progress-width: 60%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-800">{{ rand(50, 150) }}</span>
                                </div>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-600">Shares</span>
                                <div class="flex items-center space-x-2">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-purple-600 h-2 rounded-full animate-progress" style="--progress-width: 45%"></div>
                                    </div>
                                    <span class="text-sm font-bold text-gray-800">{{ rand(10, 50) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tips -->
                    <div class="bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl shadow-xl p-6 border border-yellow-100 card-hover">
                        <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <span class="mr-2 animate-bounce">💡</span> Tips Hari Ini
                        </h3>
                        <div class="glass rounded-xl p-4 border border-white/50">
                            <p class="text-sm text-gray-700 mb-3 font-medium">
                                ✨ Optimalkan SEO artikel Anda!
                            </p>
                            <p class="text-xs text-gray-600 mb-3 leading-relaxed">
                                Gunakan kata kunci yang relevan di judul dan konten untuk meningkatkan visibilitas artikel di mesin pencari.
                            </p>
                            <a href="#" class="inline-flex items-center text-xs text-blue-600 font-medium hover:text-blue-800 group">
                                Pelajari lebih lanjut
                                <svg class="w-3 h-3 ml-1 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Features Section -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Writing Progress -->
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 card-hover">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="mr-2">📊</span> Progress Menulis
                    </h4>
                    <div class="space-y-3">
                        <div>
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Target Bulanan</span>
                                <span>{{ Auth::user()->articles()->whereMonth('created_at', now()->month)->count() }}/10</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                <div class="bg-blue-600 h-2 rounded-full animate-progress" style="--progress-width: {{ min((Auth::user()->articles()->whereMonth('created_at', now()->month)->count() / 10) * 100, 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Engagement -->
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 card-hover">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="mr-2">💬</span> Engagement Terbaru
                    </h4>
                    <div class="text-center py-4">
                        <div class="text-3xl font-bold text-gray-800 mb-1">
                            {{ Auth::user()->articles()->withCount(['comments', 'likes'])->get()->sum('comments_count') + Auth::user()->articles()->withCount(['comments', 'likes'])->get()->sum('likes_count') }}
                        </div>
                        <p class="text-sm text-gray-500">Total Interaksi</p>
                    </div>
                </div>

                <!-- Quick Stats -->
                <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100 card-hover">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="mr-2">⚡</span> Statistik Cepat
                    </h4>
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <div class="text-2xl font-bold text-blue-600">{{ Auth::user()->articles()->where('status', 'draft')->count() }}</div>
                            <div class="text-xs text-gray-500">Draft</div>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-green-600">{{ Auth::user()->articles()->where('created_at', '>=', now()->startOfWeek())->count() }}</div>
                            <div class="text-xs text-gray-500">Minggu Ini</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk interaktifitas -->
    <script>
        // Share artikel function
        function shareArticle(title, url) {
            if (navigator.share) {
                navigator.share({
                    title: title,
                    url: url
                }).catch(console.error);
            } else {
                // Fallback copy to clipboard
                navigator.clipboard.writeText(url).then(() => {
                    // Show toast notification
                    showNotification('Link artikel berhasil disalin!', 'success');
                }).catch(err => {
                    console.error('Could not copy text: ', err);
                    showNotification('Gagal menyalin link artikel', 'error');
                });
            }
        }

        // Show notification toast
        function showNotification(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg text-white font-medium transform translate-x-full transition-all duration-300 ${
                type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500'
            }`;
            toast.textContent = message;
            
            document.body.appendChild(toast);
            
            // Slide in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);
            
            // Slide out and remove
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 3000);
        }

        // Progressive loading untuk artikel dengan lazy load
        const observerOptions = {
            root: null,
            rootMargin: '50px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('fade-in-visible');
                }
            });
        }, observerOptions);

        // Observe semua artikel
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.fade-in').forEach(article => {
                observer.observe(article);
            });

            // Add smooth animation delay untuk staggered effect
            const cards = document.querySelectorAll('.fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = (index * 100) + 'ms';
            });
        });

        // Smooth scroll untuk internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl/Cmd + K untuk quick search (jika ada)
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                console.log('Quick search shortcut');
            }
            
            // Escape untuk menutup modals
            if (e.key === 'Escape') {
                console.log('Escape pressed');
            }
        });
    </script>

    <style>
        /* Enhanced animations */
        .fade-in {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .fade-in-visible {
            opacity: 1 !important;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Line clamp utility */
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 1;
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        /* Enhanced scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }

        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</x-app-layout>

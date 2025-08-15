<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            Aktivitas Terbaru
        </x-slot>

        <div class="space-y-4">
            @if($recentArticles->count() > 0)
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        {{ $isAdmin ? 'Artikel Terbaru (Semua)' : 'Artikel Terbaru Anda' }}
                    </h4>
                    <div class="space-y-2">
                        @foreach($recentArticles as $article)
                            <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                        {{ Str::limit($article->title, 50) }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        @if($isAdmin)
                                            oleh {{ $article->user->name }} • 
                                        @endif
                                        {{ $article->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $article->status === 'published' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 
                                       ($article->status === 'draft' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' : 
                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300') }}">
                                    {{ ucfirst($article->status) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($recentComments->count() > 0)
                <div>
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        {{ $isAdmin ? 'Komentar Terbaru (Semua)' : 'Komentar pada Artikel Anda' }}
                    </h4>
                    <div class="space-y-2">
                        @foreach($recentComments as $comment)
                            <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                        <span class="text-xs font-medium text-white">
                                            {{ substr($comment->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-900 dark:text-gray-100">
                                        {{ Str::limit($comment->content, 80) }}
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        oleh {{ $comment->user->name }} pada 
                                        "{{ Str::limit($comment->article->title, 30) }}"
                                        • {{ $comment->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if($recentArticles->count() === 0 && $recentComments->count() === 0)
                <div class="text-center py-6">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h3 class="text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada aktivitas</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        {{ $isAdmin ? 'Belum ada artikel atau komentar di sistem' : 'Mulai menulis artikel pertama Anda' }}
                    </p>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

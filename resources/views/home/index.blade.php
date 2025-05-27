<x-app-layout>
    <x-slot name="title">Главная</x-slot>
    <x-slot name="description">Исследуем прошлое, чтобы понять настоящее. Увлекательные исторические статьи, личности и события.</x-slot>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-ink-500 to-ink-600 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-display font-bold mb-6">
                    Путешествие в прошлое
                </h1>
                <p class="text-xl md:text-2xl text-parchment-200 mb-8 max-w-3xl mx-auto leading-relaxed">
                    Откройте для себя удивительные истории, которые сформировали наш мир.
                    От древних цивилизаций до великих открытий.
                </p>
                <a href="{{ route('posts.index') }}"
                   class="inline-flex items-center bg-gold-500 hover:bg-gold-600 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors shadow-lg">
                    <i class="fas fa-book-open mr-2"></i>
                    Читать статьи
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Posts -->
    @if($featuredPosts->count() > 0)
        <section class="py-16 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-display font-bold text-ink-500 mb-4">
                        Рекомендуемые статьи
                    </h2>
                    <p class="text-lg text-ink-400 max-w-2xl mx-auto">
                        Самые интересные и важные материалы, отобранные нашими редакторами
                    </p>
                </div>

                <div class="space-y-8">
                    @foreach($featuredPosts as $post)
                        <x-post-card :post="$post" :featured="true" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Recent Posts & Sidebar -->
    <section class="py-16 bg-parchment-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Recent Posts -->
                <div class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl md:text-3xl font-display font-bold text-ink-500">
                            Последние публикации
                        </h2>
                        <a href="{{ route('posts.index') }}"
                           class="text-gold-600 hover:text-gold-700 font-medium transition-colors">
                            Все статьи →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($recentPosts as $post)
                            <x-post-card :post="$post" />
                        @endforeach
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Categories -->
                    <x-category-list :categories="$categories" />

                    <!-- Popular Tags -->
                    <x-tag-cloud :tags="$popularTags" />

                    <!-- Newsletter -->
                    <div class="bg-gradient-to-br from-gold-500 to-gold-600 rounded-lg p-6 text-white">
                        <h3 class="text-lg font-display font-semibold mb-3">
                            <i class="fas fa-envelope mr-2"></i>
                            Подписка на новости
                        </h3>
                        <p class="text-gold-100 mb-4 text-sm">
                            Получайте уведомления о новых статьях и интересных исторических фактах
                        </p>
                        <form class="space-y-3">
                            <input type="email"
                                   placeholder="Ваш email"
                                   class="w-full px-4 py-2 rounded-lg border-0 text-ink-500 placeholder-ink-400 focus:ring-2 focus:ring-white">
                            <button type="submit"
                                    class="w-full bg-white text-gold-600 px-4 py-2 rounded-lg font-semibold hover:bg-parchment-50 transition-colors">
                                Подписаться
                            </button>
                        </form>
                    </div>

                    <!-- Historical Quote -->
                    <div class="bg-white rounded-lg shadow-sm border border-parchment-200 p-6">
                        <h3 class="text-lg font-display font-semibold text-ink-500 mb-4 flex items-center">
                            <i class="fas fa-quote-left mr-2 text-gold-500"></i>
                            Цитата дня
                        </h3>
                        <blockquote class="text-ink-400 italic mb-3">
                            "История — это философия, преподающая на примерах."
                        </blockquote>
                        <cite class="text-sm text-ink-500 font-medium">— Дионисий Галикарнасский</cite>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-ink-500 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">500+</div>
                    <div class="text-parchment-200">Статей</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">50+</div>
                    <div class="text-parchment-200">Авторов</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">10K+</div>
                    <div class="text-parchment-200">Читателей</div>
                </div>
                <div>
                    <div class="text-3xl md:text-4xl font-bold text-gold-400 mb-2">25</div>
                    <div class="text-parchment-200">Стран</div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>

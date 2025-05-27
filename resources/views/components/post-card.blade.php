@props(['post', 'featured' => false])

<article class="bg-white rounded-lg shadow-sm border border-parchment-200 overflow-hidden hover:shadow-md transition-shadow duration-300 {{ $featured ? 'md:flex' : '' }}">
    @if($post->featured_image)
        <div class="{{ $featured ? 'md:w-1/2' : '' }} relative">
            <img src="{{ $post->featured_image }}"
                 alt="{{ $post->title }}"
                 class="w-full {{ $featured ? 'h-64 md:h-full' : 'h-48' }} object-cover">

            @if($post->is_featured)
                <div class="absolute top-3 left-3">
                    <span class="bg-burgundy-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-star mr-1"></i>
                        Рекомендуем
                    </span>
                </div>
            @endif
        </div>
    @endif

    <div class="{{ $featured ? 'md:w-1/2' : '' }} p-6">
        <!-- Категория и дата -->
        <div class="flex items-center justify-between mb-3">
            <a href="{{ route('categories.show', $post->category->slug) }}"
               class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium transition-colors"
               style="background-color: {{ $post->category->color }}20; color: {{ $post->category->color }};">
                @if($post->category->icon)
                    <i class="{{ $post->category->icon }} mr-1"></i>
                @endif
                {{ $post->category->name }}
            </a>

            <time class="text-sm text-ink-400" datetime="{{ $post->published_at->format('Y-m-d') }}">
                {{ $post->published_at->format('d.m.Y') }}
            </time>
        </div>

        <!-- Заголовок -->
        <h3 class="{{ $featured ? 'text-xl md:text-2xl' : 'text-lg' }} font-display font-semibold text-ink-500 mb-3 leading-tight">
            <a href="{{ route('posts.show', $post->slug) }}" class="hover:text-gold-600 transition-colors">
                {{ $post->title }}
            </a>
        </h3>

        <!-- Отрывок -->
        @if($post->excerpt)
            <p class="text-ink-400 mb-4 {{ $featured ? 'text-base' : 'text-sm' }} leading-relaxed">
                {{ Str::limit($post->excerpt, $featured ? 150 : 100) }}
            </p>
        @endif

        <!-- Метаинформация -->
        <div class="flex items-center justify-between text-sm text-ink-400">
            <div class="flex items-center space-x-4">
                <!-- Автор -->
                <div class="flex items-center">
                    @if($post->user->avatar)
                        <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-6 h-6 rounded-full mr-2">
                    @else
                        <i class="fas fa-user-circle text-lg mr-2"></i>
                    @endif
                    <span>{{ $post->user->name }}</span>
                </div>

                <!-- Время чтения -->
                <div class="flex items-center">
                    <i class="fas fa-clock mr-1"></i>
                    <span>{{ $post->reading_time }} мин</span>
                </div>
            </div>

            <!-- Статистика -->
            <div class="flex items-center space-x-3">
                <span class="flex items-center">
                    <i class="fas fa-eye mr-1"></i>
                    {{ $post->views_count }}
                </span>
                @if($post->allow_comments)
                    <span class="flex items-center">
                        <i class="fas fa-comments mr-1"></i>
                        {{ $post->comments_count }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Теги -->
        @if($post->tags->count() > 0)
            <div class="mt-4 flex flex-wrap gap-2">
                @foreach($post->tags->take(3) as $tag)
                    <a href="{{ route('tags.show', $tag->slug) }}"
                       class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-parchment-100 text-ink-500 hover:bg-gold-100 hover:text-gold-700 transition-colors">
                        <i class="fas fa-tag mr-1"></i>
                        {{ $tag->name }}
                    </a>
                @endforeach
                @if($post->tags->count() > 3)
                    <span class="text-xs text-ink-400">+{{ $post->tags->count() - 3 }}</span>
                @endif
            </div>
        @endif
    </div>
</article>

@props(['tags'])

<div class="bg-white rounded-lg shadow-sm border border-parchment-200 p-6">
    <h3 class="text-lg font-display font-semibold text-ink-500 mb-4 flex items-center">
        <i class="fas fa-tags mr-2 text-gold-500"></i>
        Популярные теги
    </h3>

    <div class="flex flex-wrap gap-2">
        @foreach($tags as $tag)
            @php
                $size = match(true) {
                    $tag->posts_count >= 10 => 'text-lg',
                    $tag->posts_count >= 5 => 'text-base',
                    default => 'text-sm'
                };
            @endphp
            <a href="{{ route('tags.show', $tag->slug) }}"
               class="inline-flex items-center px-3 py-1 rounded-full {{ $size }} font-medium bg-parchment-100 text-ink-500 hover:bg-gold-100 hover:text-gold-700 transition-colors">
                {{ $tag->name }}
                <span class="ml-1 text-xs opacity-75">({{ $tag->posts_count }})</span>
            </a>
        @endforeach
    </div>
</div>

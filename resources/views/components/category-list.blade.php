@props(['categories'])

<div class="bg-white rounded-lg shadow-sm border border-parchment-200 p-6">
    <h3 class="text-lg font-display font-semibold text-ink-500 mb-4 flex items-center">
        <i class="fas fa-folder-open mr-2 text-gold-500"></i>
        Категории
    </h3>

    <div class="space-y-2">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}"
               class="flex items-center justify-between p-3 rounded-lg hover:bg-parchment-50 transition-colors group">
                <div class="flex items-center">
                    @if($category->icon)
                        <i class="{{ $category->icon }} mr-3 text-lg" style="color: {{ $category->color }};"></i>
                    @else
                        <div class="w-4 h-4 rounded-full mr-3" style="background-color: {{ $category->color }};"></div>
                    @endif
                    <span class="font-medium text-ink-500 group-hover:text-gold-600 transition-colors">
                        {{ $category->name }}
                    </span>
                </div>
                <span class="text-sm text-ink-400 bg-parchment-100 px-2 py-1 rounded-full">
                    {{ $category->published_posts_count ?? 0 }}
                </span>
            </a>
        @endforeach
    </div>
</div>

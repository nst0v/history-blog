<?php

namespace App\Services;

class HomeService
{
    public function __construct(
        private PostService $postService,
        private CategoryService $categoryService,
        private TagService $tagService
    ) {}

    public function getHomePageData(): array
    {
        return [
            'featuredPosts' => $this->postService->getFeaturedPosts(3),
            'recentPosts' => $this->postService->getRecentPosts(6),
            'categories' => $this->categoryService->getActiveCategories(),
            'popularTags' => $this->tagService->getPopularTags(15),
        ];
    }
}

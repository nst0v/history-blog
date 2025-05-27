<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private CategoryRepositoryInterface $categoryRepository,
        private TagRepositoryInterface $tagRepository
    ) {}

    public function getAllPosts(int $perPage = 15): LengthAwarePaginator
    {
        return $this->postRepository->getPublishedPaginated($perPage);
    }

    public function getPostBySlug(string $slug): ?object
    {
        $post = $this->postRepository->findBySlug($slug);

        if ($post) {
            $this->postRepository->incrementViews($post->id);
        }

        return $post;
    }

    public function getFeaturedPosts(int $limit = 5): Collection
    {
        return $this->postRepository->getFeatured($limit);
    }

    public function getRecentPosts(int $limit = 5): Collection
    {
        return $this->postRepository->getRecent($limit);
    }

    public function getPostsByCategory(string $categorySlug, int $perPage = 15): array
    {
        $category = $this->categoryRepository->findBySlug($categorySlug);

        if (!$category) {
            return ['posts' => null, 'category' => null];
        }

        $posts = $this->postRepository->getByCategory($categorySlug, $perPage);

        return ['posts' => $posts, 'category' => $category];
    }

    public function getPostsByTag(string $tagSlug, int $perPage = 15): array
    {
        $tag = $this->tagRepository->findBySlug($tagSlug);

        if (!$tag) {
            return ['posts' => null, 'tag' => null];
        }

        $posts = $this->postRepository->getByTag($tagSlug, $perPage);

        return ['posts' => $posts, 'tag' => $tag];
    }

    public function searchPosts(string $query, int $perPage = 15): LengthAwarePaginator
    {
        return $this->postRepository->search($query, $perPage);
    }
}

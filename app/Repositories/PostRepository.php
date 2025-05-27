<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function getPublished(): Collection
    {
        return $this->model->published()
            ->with(['user', 'category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->get();
    }

    public function getPublishedPaginated(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->published()
            ->with(['user', 'category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function getFeatured(int $limit = 5): Collection
    {
        return $this->model->published()
            ->featured()
            ->with(['user', 'category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getByCategory(string $categorySlug, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->published()
            ->byCategory($categorySlug)
            ->with(['user', 'category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function getByTag(string $tagSlug, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->published()
            ->whereHas('tags', function ($query) use ($tagSlug) {
                $query->where('slug', $tagSlug);
            })
            ->with(['user', 'category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function getRecent(int $limit = 5): Collection
    {
        return $this->model->published()
            ->with(['user', 'category'])
            ->orderBy('published_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function incrementViews(int $postId): void
    {
        $this->model->where('id', $postId)->increment('views_count');
    }

    public function search(string $query, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'ILIKE', "%{$query}%")
                  ->orWhere('content', 'ILIKE', "%{$query}%")
                  ->orWhere('excerpt', 'ILIKE', "%{$query}%");
            })
            ->with(['user', 'category', 'tags'])
            ->orderBy('published_at', 'desc')
            ->paginate($perPage);
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->model->where('slug', $slug)
            ->with(['user', 'category', 'tags', 'approvedComments.user'])
            ->first();
    }
}

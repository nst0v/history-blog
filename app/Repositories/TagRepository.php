<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function __construct(Tag $model)
    {
        parent::__construct($model);
    }

    public function getPopular(int $limit = 20): Collection
    {
        return $this->model->where('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getWithPostsCount(): Collection
    {
        return $this->model->where('posts_count', '>', 0)
            ->orderBy('posts_count', 'desc')
            ->get();
    }

    public function search(string $query): Collection
    {
        return $this->model->where('name', 'ILIKE', "%{$query}%")
            ->orderBy('posts_count', 'desc')
            ->limit(10)
            ->get();
    }

    public function findBySlug(string $slug): ?Tag
    {
        return $this->model->where('slug', $slug)->first();
    }
}

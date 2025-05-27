<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getActive(): Collection
    {
        return $this->model->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function getWithPostsCount(): Collection
    {
        return $this->model->where('is_active', true)
            ->withCount(['publishedPosts'])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function getParentCategories(): Collection
    {
        return $this->model->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function getChildren(int $parentId): Collection
    {
        return $this->model->where('is_active', true)
            ->where('parent_id', $parentId)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();
    }

    public function findBySlug(string $slug): ?Category
    {
        return $this->model->where('slug', $slug)
            ->where('is_active', true)
            ->first();
    }
}

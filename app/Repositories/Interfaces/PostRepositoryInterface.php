<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface extends BaseRepositoryInterface
{
    public function getPublished(): Collection;

    public function getPublishedPaginated(int $perPage = 15): LengthAwarePaginator;

    public function getFeatured(int $limit = 5): Collection;

    public function getByCategory(string $categorySlug, int $perPage = 15): LengthAwarePaginator;

    public function getByTag(string $tagSlug, int $perPage = 15): LengthAwarePaginator;

    public function getRecent(int $limit = 5): Collection;

    public function incrementViews(int $postId): void;

    public function search(string $query, int $perPage = 15): LengthAwarePaginator;
}

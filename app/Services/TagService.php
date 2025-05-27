<?php

namespace App\Services;

use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class TagService
{
    public function __construct(
        private TagRepositoryInterface $tagRepository
    ) {}

    public function getAllTags(): Collection
    {
        return $this->tagRepository->getWithPostsCount();
    }

    public function getPopularTags(int $limit = 20): Collection
    {
        return $this->tagRepository->getPopular($limit);
    }

    public function getTagBySlug(string $slug): ?object
    {
        return $this->tagRepository->findBySlug($slug);
    }

    public function searchTags(string $query): Collection
    {
        return $this->tagRepository->search($query);
    }
}

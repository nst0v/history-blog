<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    public function getAllCategories(): Collection
    {
        return $this->categoryRepository->getWithPostsCount();
    }

    public function getCategoryBySlug(string $slug): ?object
    {
        return $this->categoryRepository->findBySlug($slug);
    }

    public function getActiveCategories(): Collection
    {
        return $this->categoryRepository->getActive();
    }

    public function getParentCategories(): Collection
    {
        return $this->categoryRepository->getParentCategories();
    }
}

<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getActive(): Collection;

    public function getWithPostsCount(): Collection;

    public function getParentCategories(): Collection;

    public function getChildren(int $parentId): Collection;
}

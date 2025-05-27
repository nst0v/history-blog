<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TagRepositoryInterface extends BaseRepositoryInterface
{
    public function getPopular(int $limit = 20): Collection;

    public function getWithPostsCount(): Collection;

    public function search(string $query): Collection;
}

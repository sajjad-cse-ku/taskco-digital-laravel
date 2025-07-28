<?php
// app/Repositories/Interfaces/BlogPostRepositoryInterface.php

namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Models\BlogPost;

interface BlogPostRepositoryInterface
{
    public function all(?string $search = null): LengthAwarePaginator;
    public function create(array $data): BlogPost;
    public function update(BlogPost $blogPost, array $data): bool;
    public function delete(BlogPost $blogPost): bool;
}

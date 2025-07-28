<?php
// app/Services/BlogPostService.php

namespace App\Services;

use App\Models\BlogPost;
use App\Repositories\Interfaces\BlogPostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogPostService
{
    protected BlogPostRepositoryInterface $blogRepo;

    public function __construct(BlogPostRepositoryInterface $blogRepo)
    {
        $this->blogRepo = $blogRepo;
    }

    public function list(?string $search = null): LengthAwarePaginator
    {
        return $this->blogRepo->all($search);
    }

    public function store(array $data): BlogPost
    {
        return $this->blogRepo->create($data);
    }

    public function update(BlogPost $post, array $data): bool
    {
        return $this->blogRepo->update($post, $data);
    }

    public function destroy(BlogPost $post): bool
    {
        return $this->blogRepo->delete($post);
    }
}

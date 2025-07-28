<?php
// app/Repositories/BlogPostRepository.php

namespace App\Repositories;

use App\Models\BlogPost;
use App\Repositories\Interfaces\BlogPostRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogPostRepository implements BlogPostRepositoryInterface
{
    public function all(?string $search = null): LengthAwarePaginator
    {
        return BlogPost::when($search, function($query, $search) {
            $query->where('title', 'like', "%{$search}%");
        })
            ->orderBy('id', 'desc')
            ->paginate(5);
    }

    public function create(array $data): BlogPost
    {
        return BlogPost::create($data);
    }

    public function update(BlogPost $blogPost, array $data): bool
    {
        return $blogPost->update($data);
    }

    public function delete(BlogPost $blogPost): bool
    {
        return $blogPost->delete();
    }
}

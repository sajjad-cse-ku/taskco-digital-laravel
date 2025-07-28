<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use App\Services\BlogPostService;
use Illuminate\Http\Request;


class BlogPostApiController extends Controller
{
    protected BlogPostService $service;

    public function __construct(BlogPostService $service)
    {
        $this->service = $service;
    }

    // GET /api/blog-posts
    public function index(Request $request)
    {
        $search = $request->query('search');
        $posts = $this->service->list($search);

        return BlogPostResource::collection($posts);
    }

    // GET /api/blog-posts/{id}
    public function show(BlogPost $blogpost)
    {
        return new BlogPostResource($blogpost);
    }
}

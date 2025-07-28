<?php

// app/Http/Controllers/Admin/BlogPostController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogPostRequest;
use App\Models\BlogPost;
use App\Services\BlogPostService;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    protected BlogPostService $service;

    public function __construct(BlogPostService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $posts = $this->service->list($search);

        if ($request->ajax()) {
            $html = view('admin.blogposts.partials.posts_table', compact('posts'))->render();
            $pagination = $posts->links();
            return response()->json(['html' => $html, 'pagination' => $pagination]);
        }

        return view('admin.blogposts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blogposts.create');
    }

    public function store(BlogPostRequest $request)
    {
        $this->service->store($request->validated());
        return redirect()->route('admin.blogposts.index')->with('success', 'Blog post created successfully.');
    }

    public function edit(BlogPost $blogpost)
    {
        return view('admin.blogposts.edit', compact('blogpost'));
    }

    public function update(BlogPostRequest $request, BlogPost $blogpost)
    {
        $this->service->update($blogpost, $request->validated());
        return redirect()->route('admin.blogposts.index')->with('success', 'Blog post updated successfully.');
    }

    public function destroy(BlogPost $blogpost)
    {
        $this->service->destroy($blogpost);
        return response()->json(['success' => true]);
    }
}

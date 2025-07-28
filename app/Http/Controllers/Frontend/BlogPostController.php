<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index(Request $request)
    {
        $query = BlogPost::query();
        if ($request->ajax()) {
            if ($request->search) {
                $query->where('title', 'like', "%{$request->search}%");
            }
            $posts = $query->orderBy('id', 'desc')->paginate(5);
            return view('frontend.blogposts.partials.posts_list', compact('posts'))->render();
        }else{
            $posts = $query->orderBy('id', 'desc')->paginate(5);
        }

        return view('frontend.blogposts.index',compact('posts'))->render();
    }

    public function show(BlogPost $blogpost)
    {
        return view('frontend.blogposts.show', compact('blogpost'));
    }
}

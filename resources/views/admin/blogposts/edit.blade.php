@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Blog Post</h1>

        <form action="{{ route('admin.blogposts.update', $blogpost) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title', $blogpost->title) }}" class="form-control" required>
                @error('title')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label>Author</label>
                <input type="text" name="author" value="{{ old('author', $blogpost->author) }}" class="form-control">
                @error('author')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" rows="5" class="form-control" required>{{ old('content', $blogpost->content) }}</textarea>
                @error('content')<small class="text-danger">{{ $message }}</small>@enderror
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.blogposts.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection

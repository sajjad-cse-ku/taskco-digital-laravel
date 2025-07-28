@extends('layouts.app')

@section('content')
    <div class="container py-5" style="max-width: 720px;">
        <div class="mb-4">
            <h1 class="h3 text-primary fw-bold mb-2">📝 Edit Blog Post</h1>
            <p class="text-muted">Make changes to the blog post and click "Update" to save.</p>
        </div>

        <form action="{{ route('admin.blogposts.update', $blogpost) }}" method="POST" class="bg-white border rounded shadow-sm p-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Post Title <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $blogpost->title) }}" class="form-control @error('title') is-invalid @enderror">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="author" class="form-label fw-semibold">Author</label>
                <input type="text" id="author" name="author" value="{{ old('author', $blogpost->author) }}" class="form-control @error('author') is-invalid @enderror">
                @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                <textarea id="content" name="content" rows="6" class="form-control @error('content') is-invalid @enderror">{{ old('content', $blogpost->content) }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.blogposts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Post
                </button>
            </div>
        </form>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container py-5" style="max-width: 720px;">
        <div class="mb-4">
            <h1 class="h3 text-primary fw-bold mb-3">✍️ Create New Blog Post</h1>
            <p class="text-muted">Fill out the fields below to add a new blog post.</p>
        </div>

        <form action="{{ route('admin.blogposts.store') }}" method="POST" class="bg-white border rounded shadow-sm p-4">
            @csrf

            <div class="mb-4">
                <label for="title" class="form-label fw-semibold">Post Title <span class="text-danger">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" required>
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="author" class="form-label fw-semibold">Author</label>
                <input type="text" id="author" name="author" value="{{ old('author') }}" class="form-control @error('author') is-invalid @enderror">
                @error('author')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="content" class="form-label fw-semibold">Content <span class="text-danger">*</span></label>
                <textarea id="content" name="content" rows="6" class="form-control @error('content') is-invalid @enderror" required>{{ old('content') }}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.blogposts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> Save Post
                </button>
            </div>
        </form>
    </div>
@endsection

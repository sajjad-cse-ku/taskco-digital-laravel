@extends('layouts.app')

@section('content')
    <div class="container py-5 max-w-3xl mx-auto">
        <article class="bg-light rounded-4 shadow p-5 border-start border-4 border-primary">
            <h1 class="mb-4 fw-bold text-primary">
                {{ $blogpost->title }}
            </h1>

            <div class="d-flex flex-wrap align-items-center text-secondary mb-4 small">
            <span class="me-3">
                <strong>{{ $blogpost->author ?? 'Unknown' }}</strong>
            </span>
                <span class="text-muted">|</span>
                <time class="ms-3" datetime="{{ $blogpost->created_at->toDateString() }}">
                    {{ $blogpost->created_at->format('M d, Y') }}
                </time>
            </div>

            <div class="fs-5 text-dark" style="white-space: pre-line; line-height: 1.7;">
                {!! e($blogpost->content) !!}
            </div>

            <a href="{{ route('frontend.blogposts.index') }}" class="btn btn-outline-primary mt-5">
                &larr; Back to Posts
            </a>
        </article>
    </div>
@endsection

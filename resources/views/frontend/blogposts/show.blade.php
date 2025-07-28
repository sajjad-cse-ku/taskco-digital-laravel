@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $blogpost->title }}</h1>
        <p><small>By {{ $blogpost->author ?? 'Unknown' }} on {{ $blogpost->created_at->format('Y-m-d') }}</small></p>

        <div>{!! nl2br(e($blogpost->content)) !!}</div>

        <a href="{{ route('frontend.blogposts.index') }}" class="btn btn-secondary mt-3">Back to Posts</a>
    </div>
@endsection

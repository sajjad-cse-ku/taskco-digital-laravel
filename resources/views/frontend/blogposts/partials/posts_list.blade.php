<style>
    .badge-author {
        background-color: #dbeafe; /* Tailwind blue-200 */
        color: #1e40af;           /* Tailwind blue-800 */
        font-weight: 500;
    }

    .badge-date {
        background-color: #d1fae5; /* Tailwind green-100 */
        color: #166534;            /* Tailwind green-800 */
        font-weight: 500;
    }

    .badge-rounded {
        border-radius: 9999px;
        padding: 0.35rem 0.75rem;
        display: inline-flex;
        align-items: center;
        font-size: 0.875rem;
        user-select: none;
    }

    .badge-icon {
        margin-right: 0.4rem;
        font-size: 1rem;
    }

    .card-hover:hover {
        box-shadow: 0 8px 20px rgb(0 0 0 / 0.12);
        transform: translateY(-4px);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        height: 100%;
    }
</style>

@if($posts->count())
    @foreach($posts as $post)
        <div class="col-md-4">
            <div
                class="card card-hover shadow-sm border-0 h-100"
                role="button"
                tabindex="0"
                data-href="{{ route('frontend.blogposts.show', $post) }}"
                aria-label="Read blog post: {{ $post->title }}"
            >
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-truncate" title="{{ $post->title }}">
                        {{ $post->title }}
                    </h5>

                    <div class="d-flex mb-3 gap-2 flex-wrap">
                        <span class="badge-author badge-rounded" title="Author: {{ $post->author ?? 'Unknown' }}">
                            <span class="badge-icon">✍️</span>{{ $post->author ?? 'Unknown' }}
                        </span>
                        <span class="badge-date badge-rounded" title="Published on {{ $post->created_at->format('M d, Y') }}">
                            <span class="badge-icon">📅</span>{{ $post->created_at->format('M d, Y') }}
                        </span>
                    </div>

                    <p class="card-text text-secondary flex-grow-1">
                        {{ Str::limit($post->content, 110) }}
                    </p>

                    <a href="{{ route('frontend.blogposts.show', $post) }}" class="btn btn-primary mt-auto align-self-start" aria-label="Read more about {{ $post->title }}">
                        Read More →
                    </a>
                </div>
            </div>
        </div>
    @endforeach

    <div class="col-12 mt-4">
        {{ $posts->links() }}
    </div>
@else
    <div class="col-12 text-center py-5 text-muted">
        <p>No posts found.</p>
    </div>
@endif

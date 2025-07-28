@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-5 text-center fw-bold text-primary">Blog Posts</h1>

        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <input
                    type="search"
                    id="search"
                    class="form-control form-control-lg shadow-sm"
                    placeholder="Search posts..."
                    aria-label="Search blog posts"
                    autocomplete="off"
                >
            </div>
        </div>

        <div id="postsList" class="row g-4">
            @include('frontend.blogposts.partials.posts_list', ['posts' => $posts])
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            const $searchInput = $('#search');
            const $postsList = $('#postsList');
            let typingTimer;
            const doneTypingInterval = 500;

            function fetchPosts(page = 1, search = '') {
                $postsList.fadeTo(200, 0.5);

                $.ajax({
                    url: `{{ route('frontend.blogposts.index') }}?page=${page}&search=${search}`,
                    method: 'GET',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success(html) {
                        $postsList.html(html).fadeTo(200, 1);
                        attachPaginationHandlers();
                        attachCardClickHandlers();
                    },
                    error() {
                        $postsList.fadeTo(200, 1);
                        alert('Failed to load posts. Please try again.');
                    }
                });
            }

            $searchInput.on('keyup', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => fetchPosts(1, $searchInput.val()), doneTypingInterval);
            });

            function attachPaginationHandlers() {
                $postsList.find('.pagination a').off('click').on('click', function (e) {
                    e.preventDefault();
                    const href = $(this).attr('href');
                    const page = new URLSearchParams(href.split('?')[1]).get('page') || 1;
                    fetchPosts(page, $searchInput.val());
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            function attachCardClickHandlers() {
                $postsList.find('.card').off('click').on('click', function () {
                    const link = $(this).data('href');
                    if (link) window.location.href = link;
                });
            }

            // Initial binding
            attachPaginationHandlers();
            attachCardClickHandlers();
        });
    </script>
@endsection

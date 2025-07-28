@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        /* Table styling */
        .table-hover tbody tr:hover {
            background-color: #e9f0ff;
            cursor: pointer;
        }

        /* Icon buttons */
        .btn-icon {
            border: none;
            background: none;
            padding: 0.25rem 0.5rem;
            font-size: 1.3rem;
            color: #0d6efd;
            transition: color 0.25s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .btn-icon:hover {
            color: #084cd9;
            text-decoration: none;
        }

        /* Delete icon button */
        .btn-icon.delete {
            color: #dc3545;
        }
        .btn-icon.delete:hover {
            color: #a71d2a;
        }

        /* Tooltip container */
        .btn-icon[title]:hover::after {
            content: attr(title);
            position: absolute;
            background: rgba(0,0,0,0.75);
            color: #fff;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            white-space: nowrap;
            pointer-events: none;
            transform: translateY(-125%);
            opacity: 1;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }

        /* Responsive */
        .table-responsive {
            overflow-x: auto;
            scrollbar-width: thin;
        }

        /* Skeleton shimmer animation */
        @keyframes shimmer {
            0% { background-position: -250px 0; }
            100% { background-position: 250px 0; }
        }
        .skeleton-shimmer {
            animation: shimmer 1.6s infinite linear;
            background: linear-gradient(90deg, #e0e0e0 25%, #f0f0f0 50%, #e0e0e0 75%);
            background-size: 500% 100%;
            background-repeat: no-repeat;
            color: transparent !important;
            border-radius: 4px;
        }

        /* Search input width on smaller screens */
        @media (max-width: 576px) {
            #search {
                width: 100% !important;
                margin-top: 0.75rem;
            }
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Admin - Blog Posts</h1>

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div class="flex-grow-1">
                <input type="text" id="search" class="form-control" placeholder="🔍 Search posts by title..." autocomplete="off">
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.blogposts.create') }}" class="btn btn-outline-primary d-flex align-items-center gap-2">
                    <i class="bi bi-plus-circle"></i>
                    <span>Create Post</span>
                </a>
                <a href="{{ route('frontend.blogposts.index') }}" target="_blank" class="btn btn-light border d-flex align-items-center gap-2">
                    <i class="bi bi-globe2 fs-5"></i>
                    <span>Visit Website</span>
                </a>
                <a href="{{ route('admin.logout') }}" class="btn btn-outline-danger d-flex align-items-center gap-2">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </div>
        </div>


    @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase small">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col" style="min-width: 140px;">Author</th>
                    <th scope="col" style="min-width: 160px;">Created At</th>
                    <th scope="col" class="text-center" style="width: 110px;">Actions</th>
                </tr>
                </thead>
                <tbody id="postsTableBody" role="rowgroup">
                @include('admin.blogposts.partials.posts_table', ['posts' => $posts])
                </tbody>
            </table>
        </div>

        <nav id="paginationNav" class="mt-3">
            {{ $posts->links('pagination::bootstrap-5') }}
        </nav>

        <!-- Skeleton loader -->
        <div id="skeletonLoader" style="display:none;" aria-live="polite" aria-busy="true">
            <div class="table-responsive mt-3" aria-hidden="true">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>#</th><th>Title</th><th>Author</th><th>Created At</th><th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i=0; $i < 6; $i++)
                        <tr>
                            <td><span class="skeleton-shimmer d-inline-block" style="width:24px; height:1.3rem;"></span></td>
                            <td><span class="skeleton-shimmer d-block" style="height:1.3rem; border-radius:4px;"></span></td>
                            <td><span class="skeleton-shimmer d-inline-block" style="width:120px; height:1.2rem; border-radius:4px;"></span></td>
                            <td><span class="skeleton-shimmer d-inline-block" style="width:140px; height:1.2rem; border-radius:4px;"></span></td>
                            <td class="text-center">
                                <span class="btn-icon skeleton-shimmer" style="width:26px; height:26px; display:inline-block; border-radius:6px;"></span>
                                <span class="btn-icon skeleton-shimmer ms-3" style="width:26px; height:26px; display:inline-block; border-radius:6px;"></span>
                            </td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            const $searchInput = $('#search');
            const $postsTableBody = $('#postsTableBody');
            const $paginationNav = $('#paginationNav');
            const $skeletonLoader = $('#skeletonLoader');
            let typingTimer;
            const doneTypingInterval = 500;

            function fetchPosts(page = 1, search = '') {
                $postsTableBody.hide();
                $paginationNav.hide();
                $skeletonLoader.show();

                $.ajax({
                    url: `{{ route('admin.blogposts.index') }}`,
                    method: 'GET',
                    data: { page, search },
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function (data) {
                        $postsTableBody.html(data.html).show();
                        $paginationNav.html(data.pagination).show();
                        $skeletonLoader.hide();

                        attachDeleteHandlers();
                        attachRowClickHandlers();
                    },
                    error: function () {
                        $skeletonLoader.hide();
                        $postsTableBody.show();
                        $paginationNav.show();
                    }
                });
            }

            $searchInput.on('keyup', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(() => {
                    fetchPosts(1, $searchInput.val());
                }, doneTypingInterval);
            });

            function attachDeleteHandlers() {
                $('.btn-delete-post').off('click').on('click', function (e) {
                    e.stopPropagation();
                    if (!confirm('Are you sure you want to delete this post?')) return;

                    const id = $(this).data('id');

                    $.ajax({
                        url: `{{ url('admin/blogposts') }}/${id}`,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        },
                        success: function (data) {
                            if (data.success) {
                                fetchPosts(1, $searchInput.val());
                            } else {
                                alert('Failed to delete the post.');
                            }
                        }
                    });
                });
            }

            function attachRowClickHandlers() {
                // Only trigger row click if not clicking on action buttons
                $('#postsTableBody tr').off('click').on('click', function (e) {
                    if ($(e.target).closest('.btn-icon, .btn-delete-post').length === 0) {
                        const editUrl = $(this).data('edit-url');
                        if (editUrl) {
                            window.location.href = editUrl;
                        }
                    }
                });
            }

            // Initial setup
            attachDeleteHandlers();
            attachRowClickHandlers();
        });
    </script>
@endsection

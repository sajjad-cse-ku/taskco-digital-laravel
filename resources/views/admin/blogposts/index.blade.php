@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        /* Hover row highlight */
        table.table-hover tbody tr:hover {
            background-color: #f1f5f9;
            cursor: pointer;
        }

        /* Icon buttons */
        .btn-icon {
            border: none;
            background: none;
            padding: 0.2rem 0.5rem;
            font-size: 1.25rem;
            color: #0d6efd;
            transition: color 0.3s ease;
        }
        .btn-icon:hover {
            color: #0a58ca;
            text-decoration: none;
        }

        /* Delete icon button */
        .btn-icon.delete {
            color: #dc3545;
        }
        .btn-icon.delete:hover {
            color: #a71d2a;
        }

        /* Responsive table wrapper */
        .table-responsive {
            overflow-x: auto;
        }

        /* Skeleton shimmer */
        @keyframes shimmer {
            0% { background-position: -200px 0; }
            100% { background-position: 200px 0; }
        }
        .skeleton-shimmer {
            animation: shimmer 1.5s infinite linear;
            background: linear-gradient(90deg, #e0e0e0 25%, #f8f8f8 50%, #e0e0e0 75%);
            background-size: 400% 100%;
            background-repeat: no-repeat;
            color: transparent !important;
        }
    </style>
@endsection

@section('content')
    <div class="container py-4">
        <h1 class="mb-4">Admin - Blog Posts</h1>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.blogposts.create') }}" class="btn btn-success">+ Create New Post</a>
            <input type="text" id="search" class="form-control w-50" placeholder="Search by title...">
        </div>

        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col" style="min-width:120px;">Author</th>
                    <th scope="col" style="min-width:140px;">Created At</th>
                    <th scope="col" class="text-center" style="min-width:100px;">Actions</th>
                </tr>
                </thead>
                <tbody id="postsTableBody">
                @include('admin.blogposts.partials.posts_table', ['posts' => $posts])
                </tbody>
            </table>
        </div>

        <nav id="paginationNav">
            {{ $posts->links('pagination::bootstrap-5') }}
        </nav>

        <!-- Skeleton loader -->
        <div id="skeletonLoader" style="display:none;">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>#</th><th>Title</th><th>Author</th><th>Created At</th><th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for ($i=0; $i < 6; $i++)
                        <tr>
                            <td class="skeleton-shimmer" style="width:30px; height:1.2rem;"></td>
                            <td class="skeleton-shimmer" style="height:1.2rem;"></td>
                            <td class="skeleton-shimmer" style="width:120px; height:1rem;"></td>
                            <td class="skeleton-shimmer" style="width:140px; height:1rem;"></td>
                            <td>
                                <span class="btn-icon skeleton-shimmer" style="width:24px; height:24px; display:inline-block; border-radius:4px;"></span>
                                <span class="btn-icon skeleton-shimmer" style="width:24px; height:24px; display:inline-block; border-radius:4px; margin-left:10px;"></span>
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
        $(document).ready(function () {
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
                    url: `{{ route('admin.blogposts.index') }}?page=${page}&search=${search}`,
                    method: 'GET',
                    dataType: 'json',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    success: function (data) {
                        $postsTableBody.html(data.html).show();
                        $paginationNav.html(data.pagination).show();
                        $skeletonLoader.hide();

                        attachDeleteHandlers();
                        attachRowClick();
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
                typingTimer = setTimeout(function () {
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

            function attachRowClick() {
                $('#postsTableBody tr').off('click').on('click', function () {
                    const editUrl = $(this).data('edit-url');
                    if (editUrl) {
                        window.location.href = editUrl;
                    }
                });
            }

            // Initial binding
            attachDeleteHandlers();
            attachRowClick();
        });
    </script>
@endsection


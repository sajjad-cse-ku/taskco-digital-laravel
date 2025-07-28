@if($posts->count())
    @foreach($posts as $index => $post)
        <tr  class="table-row-hover">

            <td>
                <div class="fw-semibold">{{ $post->title }}</div>
            </td>

            <td>
                <small class="text-muted">{{ $post->author ?? 'Unknown' }}</small>
            </td>

            <td>
                <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
            </td>

            <td class="text-center">
                <a href="{{ route('admin.blogposts.edit', $post) }}"
                   class="btn btn-sm btn-outline-warning me-1 btn-icon" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                </a>

                <button type="button"
                        class="btn btn-sm btn-outline-danger btn-icon btn-delete-post"
                        title="Delete"
                        data-id="{{ $post->id }}">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center text-muted py-4">
            <i class="bi bi-exclamation-circle me-1"></i> No posts found.
        </td>
    </tr>
@endif

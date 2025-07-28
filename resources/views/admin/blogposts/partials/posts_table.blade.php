@if($posts->count())
    @foreach($posts as $post)
        <tr data-edit-url="{{ route('admin.blogposts.edit', $post) }}">
            <th scope="row">{{ $post->id }}</th>
            <td>{{ $post->title }}</td>
            <td><small class="text-muted">{{ $post->author ?? 'Unknown' }}</small></td>
            <td><small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small></td>
            <td>
                <a href="{{ route('admin.blogposts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                <button data-id="{{ $post->id }}" class="btn btn-sm btn-danger btn-delete-post">Delete</button>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="5" class="text-center">No posts found.</td>
    </tr>
@endif

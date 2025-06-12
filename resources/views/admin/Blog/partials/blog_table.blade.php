<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Blog Title</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Status</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($blogs as $key => $blog)
        <tr>
            <td>{{ $blogs->firstItem() + $key }}</td>
            <td>{{ $blog->blog_title }}</td>
            <td>{{ $blog->category->name ?? 'No Category' }}</td>
            <td>
                @foreach ($blog->tags as $tag)
                    <span class="badge bg-secondary">{{ $tag->tag_name }}</span>
                @endforeach
            </td>
                    <td>
                @if($blog->status === 'published')
                    <span class="badge bg-success  rounded-0 px-3 py-2">Published</span>
                @else
                    <span class="badge bg-danger rounded-0 px-3 py-2">Draft</span>
                @endif
            </td>
            <td>{{ \Illuminate\Support\Str::limit($blog->blog_content, 100) }}</td>
            <td>
                @if ($blog->blog_image)
                    <img src="{{ asset($blog->blog_image) }}" alt="Image" width="80" />
                @endif
            </td>
            <td> @if($blog->status != 'published')
                <a href="{{ route('blogs.edit', $blog->blog_id) }}" class="btn btn-sm btn-primary">Edit</a>
                 <a href="javascript:void(0);" class="btn btn-sm btn-info" data-id="{{ $blog->blog_id }}"> <i class="mdi mdi-eye"></i> Publish</a>
                @endif

                <form action="{{ route('blogs.destroy', $blog->blog_id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Confirm delete?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
             

            </td>
          
        </tr>
    @empty
        <tr><td colspan="8" class="text-center">No blogs found.</td></tr>
    @endforelse
    </tbody>
</table>

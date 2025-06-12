@extends('admin.layouts.layout')

@section('content')
<div class="container">
    <h5>Blogs</h5>

             @if (session('success') || session('error'))
                    <div id="common-message" class="alert 
                        @if(session('success')) alert-success @endif
                        @if(session('error')) alert-danger @endif">
                        
                        @if (session('success'))
                            {{ session('success') }}
                        @elseif (session('error'))
                            {{ session('error') }}
                        @endif
                    </div>
                @endif

    {{-- Filters --}}
    <div class="mb-3">
        <input type="text" id="filter-title" placeholder="Search title" class="form-control mb-2" />
        
        <select id="filter-category" class="form-select mb-2">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>

        <select id="filter-tag" class="form-select mb-2">
            <option value="">All Tags</option>
            @foreach ($tags as $tag)
                <option value="{{ $tag->tag_id }}">{{ $tag->tag_name }}</option>
            @endforeach
        </select>

        <select id="filter-status" class="form-select mb-2">
            <option value="">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
<div class="d-flex justify-content-between align-items-center mb-3">
    <a href="{{ route('blogs.create') }}" class="btn btn-primary">Create Blog</a>
    <button id="filter-clear" class="btn btn-secondary">Clear Filters</button>
</div>




    </div>
    
           

       


    {{-- Blog table will load here --}}
    <div id="blogs-table">
        @include('admin.Blog.partials.blog_table', ['blogs' => $blogs])
    </div>

    <div id="pagination-links">
        {!! $blogs->links() !!}
    </div>
</div>
@endsection

@section('script')
<script>
$(document).ready(function () {

    
    
    // ✅ Set CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadBlogs(page = 1) {
        console.log('ttttttt');
        
        
        let title = $('#filter-title').val();
        let category = $('#filter-category').val();
        let tag = $('#filter-tag').val();
        let status = $('#filter-status').val();

        $.ajax({
            url: "{{ route('blogs.fetch') }}",
            type: 'POST',
            data: {
                title: title,
                category: category,
                tag: tag,
                status: status,
                page: page
            },
            success: function (data) {
                $('#blogs-table').html(data.blogs);
                $('#pagination-links').html(data.pagination);
            },
            error: function () {
                alert('Something went wrong');
            }
        });
    }

    $('#filter-title, #filter-category, #filter-tag, #filter-status').on('change keyup', function () {
        console.log('heloooo');
        loadBlogs(1);
    });

    $(document).on('click', '#pagination-links a', function (e) {
        e.preventDefault();
        let url = new URL($(this).attr('href'));
        let page = url.searchParams.get("page") || 1;
        loadBlogs(page);
    });
//filter clear
    $('#filter-clear').click(function () {
        $('#filter-title').val('');
        $('#filter-category').val('');
        $('#filter-tag').val('');
        $('#filter-status').val('');
        loadBlogs(1);
    });
 //publish button
 $(document).on('click', '.publish-btn', function () {
            let blogId = $(this).data('id');

            $.ajax({
                url: "{{ route('blogs.publish') }}",
                type: 'POST',
                data: { id: blogId },
                success: function (response) {
                    alert(response.message);
                    
                    location.reload(); 
                },
                error: function () {
                    alert('Something went wrong');
                }
            });
        });


});
</script>
@endsection

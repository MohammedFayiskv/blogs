@extends('admin.layouts.layout')

@section('content')
<div class="container-XXl">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    @if(isset($blog))
                        Edit Blog
                    @else
                        Add Blog
                    @endif
                </h5>

                @if (session('error'))
                    <div id="common-message" class="alert alert-danger">
                            {{ session('error') }}
                    </div>
                @endif


                <form action="{{ isset($blog) ? route('blogs.update', $blog->blog_id) : route('blogs.store') }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($blog))
                        @method('PUT')
                    @endif
                         
                    <div class="form-group">
                        <label for="name">Blog Title</label>
                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                               id="name" value="{{ old('name', $blog->blog_title ?? '') }}">
                        @if ($errors->has('name'))
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>

                  

                                            <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="blogDiscrption"  class="form-control summernote">
                                {{ old('description', $blog->blog_content ?? '') }}
                            </textarea>
                            @if ($errors->has('description'))
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                            @endif
                        </div>

                
                        <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" name="blog_image" id="image-upload" class="form-control-file {{ $errors->has('blog_image') ? 'is-invalid' : '' }}" accept="image/*" onchange="previewImage(event)">

                                @if ($errors->has('blog_image'))
                                    <div class="text-danger">{{ $errors->first('blog_image') }}</div>
                                @endif

                                <div id="image-preview" style="margin-top: 15px;">
                                    @if(isset($blog) && $blog->blog_image)
                                        <img id="preview-img"  data-existing="{{ asset($blog->blog_image ?? '') }}" src="{{ asset('/' . $blog->blog_image) }}" class="mt-2" width="100">
                                    
                                    @endif
                                </div>
                            </div>
                 
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" class="form-control {{ $errors->has('category_id') ? 'is-invalid' : '' }}">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('category_id', $blog->blog_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('category_id'))
                            <div class="text-danger">{{ $errors->first('category_id') }}</div>
                        @endif
                    </div>

                  
                    <div class="form-group">
            <label for="tags">Select Tags</label>
            <select id="tags" name="tags[]" class="form-control" data-mdb-select-init multiple data-mdb-placeholder="Select Tags" multiple>
            <option disabled>Select tag</option>
            @foreach($tags as $tag)
                <option value="{{ $tag->tag_id }}" 
                    {{ isset($blog) && $blog->items && $blog->items->contains('blgtag_tag_id', $tag->tag_id) ? 'selected' : '' }}>
                    {{ $tag->tag_name }}
                </option>
            @endforeach
        </select>
    @if ($errors->has('tags'))
        <div class="text-danger">{{ $errors->first('tags') }}</div>
    @endif
</div>



                
                    <div class="text-center mt-2">
                        <button type="submit" class="btn btn-primary">{{ isset($blog) ? 'Update' : 'Create' }} Blog</button>
                       
                        <button type="button" class="btn btn-danger">
                            <a href="{{ route('blogs.index') }}" style="color: white; text-decoration: none;">Back</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    
$(document).ready(function () {
    
    console.log('hellooooo');
    
    document.addEventListener("DOMContentLoaded", function() {
    const selectElement = document.getElementById("tags");
    if (selectElement) {
        new mdb.Select(selectElement);
    }

 

});


$('#blogDiscrption').summernote({
    height: 300,
    placeholder: 'Write something here...',
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['view', ['fullscreen', 'codeview', 'help']],
    ],
    fontNames: [
        'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica',
        'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Nunito',
    ],
    fontNamesIgnoreCheck: ['Nunito'],
});

    $('form').submit(function(event) {
        // Get the plain text content from Summernote
        var plainTextContent = $('#blogDiscrption').summernote('text');
        
        // Set the plain text in the hidden input field
        $('#plain-description').val(plainTextContent);
    });




function previewImage(event) {
    var input = event.target;
    var preview = document.getElementById('preview-img'); 

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = "block"; 
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        var existingImage = preview.getAttribute('data-existing');
        if (existingImage) {
            preview.src = existingImage;
            preview.style.display = "block"; 
        } else {
            preview.style.display = "none"; 
        }
    } 
    
}



    function toggleImagePreview() {
        var preview = document.getElementById("preview-img");

        if (checkbox.checked) {
            preview.style.display = "none"; 
        } else {
            preview.style.display = "block"; 
        }
    }

});
</script>
@endsection


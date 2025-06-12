@extends('admin.layouts.layout')
@section('content')
<div class="container-XXl">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    @if(isset($category))
                        Edit Category
                    @else
                        Add Category
                    @endif
                </h5>

                @if (session('error'))
                    <div id="common-message" class="alert alert-danger">
                            {{ session('error') }}
                    </div>
                @endif

                <!-- Vertical Form -->
                <form class="row g-3" 
                      action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" 
                      method="POST" id="categoryForm">
                    @csrf
                    @if(isset($category))
                        @method('PUT') <!-- If editing, use PUT method -->
                    @endif

                    <div class="col-12">
                        <label for="catName" class="form-label">Category Name</label>
                        <input type="text" name="cat_name" class="form-control  {{ $errors->has('cat_name') ? 'is-invalid' : '' }}" id="catName" 
                               value="{{ old('cat_name', $category->name ?? '') }}" required>
                        @if ($errors->has('cat_name'))
                            <div class="text-danger">{{ $errors->first('cat_name') }}</div>
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="DisplayName" class="form-label">Category Display Name</label>
                        <input type="text" name="display_name" class="form-control {{ $errors->has('display_name') ? 'is-invalid' : '' }}" id="DisplayName" 
                               value="{{ old('display_name', $category->display_name ?? '') }}" >
                        @if ($errors->has('display_name'))
                            <div class="text-danger">{{ $errors->first('display_name') }}</div>
                        @endif
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            @if(isset($category))
                                Update
                            @else
                                Submit
                            @endif
                        </button>
                
                        <button type="button" class="btn btn-danger">
                        <a href="{{ route('categories.index') }}" style="color: white; text-decoration: none;">Back</a>
                        </button>
                    </div>
                </form><!-- Vertical Form -->

            </div>
        </div>
    </div>
</div>

@endsection
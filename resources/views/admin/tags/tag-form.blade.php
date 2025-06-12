@extends('admin.layouts.layout')
@section('content')
<div class="container-XXl">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">
                    @if(isset($category))
                        Edit TAG
                    @else
                        Add TAG
                    @endif
                </h5>
                @if (session('error'))
                    <div id="common-message" class="alert alert-danger">
                            {{ session('error') }}
                    </div>
                @endif

                <form action="{{ isset($tag) ? route('tags.update', $tag->tag_id) : route('tags.store') }}" method="POST">
                    @csrf
                    @if (isset($tag))
                        @method('PUT')
                    @endif

                    <div class="form-group">
                        <label for="tag_name">Tag Name</label>
                        <input type="text" name="tag_name" class="form-control {{ $errors->has('tag_name') ? 'is-invalid' : '' }}" id="tag_name" value="{{ old('tag_name', $tag->tag_name ?? '') }}">
                        @if ($errors->has('tag_name'))
                            <div class="text-danger">{{ $errors->first('tag_name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="display_name">Display Name</label>
                        <input type="text" name="display_name" class="form-control {{ $errors->has('display_name') ? 'is-invalid' : '' }}" id="display_name" value="{{ old('display_name', $tag->tag_display_name ?? '') }}">
                        @if ($errors->has('display_name'))
                            <div class="text-danger">{{ $errors->first('display_name') }}</div>
                        @endif
                    </div>
                    <div class="text-center mt-2" >

                    <button type="submit" class="btn btn-primary">{{ isset($tag) ? 'Update' : 'Create' }} Tag</button>
                    
                        <button type="button" class="btn btn-danger">
                        <a href="{{ route('tags.index') }}" style="color: white; text-decoration: none;">Back</a>
                        </button>
                   </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection
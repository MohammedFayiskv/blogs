@extends('admin.layouts.layout')
@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tags</h5>

            <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Create Tag</a>
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

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tag Name</th>
                        <th scope="col">Display Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $key =>  $tag)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $tag->tag_name }}</td>
                            <td>{{ $tag->tag_display_name }}</td>
                            <td>
                                <a href="{{ route('tags.edit', $tag->tag_id) }}" class="btn btn-primary">Edit</a>

                                <form action="{{ route('tags.destroy', $tag->tag_id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@extends('admin.layouts.layout')

@push('styles')
@endpush

@section('content')
<div class="container-XXl">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Categories</h5>

              
                <button type="button" class="btn btn-primary" style="border-radius: 4px; padding: 10px 10px;"> 
                    <a href="{{ route('categories.create') }}" style="color: white; text-decoration: none;">Create Category</a>
                </button>

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
                            <th scope="col">Category Name</th>
                            <th scope="col">Display Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                            <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->display_name }}</td>
                                <td>
                                   
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary" style="border-radius: 6px; padding: 13px 37px;">Edit</a>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-danger" style="border-radius: 6px; padding: 13px 37px;" 
                                          onclick="return confirm('Are you sure you want to delete this category?')">
                                          Delete
                                      </button>
                                  </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')




@endsection 
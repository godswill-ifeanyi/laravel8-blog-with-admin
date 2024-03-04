@extends('layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Category</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Edit Category</li>
    </ol>

    <div class="card mt-4">
        <div class="card-header">
            <h4>
                <a href="{{url('admin/category')}}" class="btn btn-success btn-sm float-end">View Category</a>
            </h4>
        </div>

        <div class="card-body">
            @if ($errors->any())

                <div class="alert alert-danger">
                    @foreach ($errors as $error)
                        <div>{{$error}}</div>
                    @endforeach
                </div>
                
            @endif

            <form action="{{ url('admin/edit-category/'.$category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')

                <div class="mb-3">
                    <label for="">Category Name</label>
                    <input type="text" value="{{$category->name}}" class="form-control" name="name">
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea name="description" rows="5" class="form-control">{{$category->description}}</textarea>
                </div>

                <div class="mb-3">
                    <div class="mb-2 mt-4">
                        <label for="">Old Image:</label>
                        <img src="{{asset('uploads/category/'.$category->image_path)}}" width="90px" alt="Category Img">
                    </div>
                    <label for="">New Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <h6 class="mt-4">SEO Tags</h6>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" value="{{$category->meta_title}}" class="form-control" name="meta_title">
                </div>

                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control">{{$category->meta_description}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <textarea name="meta_keyword" rows="3" class="form-control">{{$category->meta_keyword}}</textarea>
                </div>

                <h6 class="mt-4">Status Mode</h6>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="">Front Status</label>
                        <input type="checkbox" {{$category->front_status == '1' ? 'checked' : ''}} name="front_status">
                    </div>
    
                    <div class=" col-md-3">
                        <label for="">Admin Status</label>
                        <input type="checkbox" {{$category->admin_status == '1' ? 'checked' : ''}} name="admin_status">
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
    
    
</div>

@endsection
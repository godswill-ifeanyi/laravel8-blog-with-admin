@extends('layouts.master')

@section('content')
<div class="container-fluid px-4">
    <h4 class="mt-4">Posts</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add Post</li>
    </ol>

    <div class="card mt-4">
        <div class="card-header">
            <h4>
                <a href="{{url('admin/posts')}}" class="btn btn-success btn-sm float-end">View Posts</a>
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

            <form action="{{ url('admin/edit-post/'.$post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')

                <div class="mb-3">
                    <label for="">Category Name</label>
                    <select name="category_id" class="form-control">
                        <option value="">--Select--</option>
                        @foreach ($category as $cateitem)
                        <option {{$cateitem->id == $post->category_id ? 'selected' : ''}} value="{{$cateitem->id}}">{{$cateitem->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Post Name</label>
                    <input type="text" value="{{$post->name}}" class="form-control" name="name">
                </div>

                <div class="mb-3">
                    <label for="">Description</label>
                    <textarea name="description" id="mySummernote" rows="5" class="form-control">{{$post->description}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="">old Image</label>
                    <img src="{{asset('uploads/post/'.$post->image_path)}}" width="90px" alt="Post image">
                </div>

                <div class="mb-3">
                    <label for="">New Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <div class="my-4">
                    <input type="text" value="{{$post->yt_iframe}}" placeholder="youtube link" class="form-control" name="yt_iframe">
                </div>

                <h6 class="mt-4">SEO Tags</h6>
                <div class="mb-3">
                    <label for="">Meta Title</label>
                    <input type="text" value="{{$post->meta_title}}" class="form-control" name="meta_title">
                </div>

                <div class="mb-3">
                    <label for="">Meta Description</label>
                    <textarea name="meta_description" rows="3" class="form-control">{{$post->meta_description}}</textarea>
                </div>

                <div class="mb-3">
                    <label for="">Meta Keyword</label>
                    <textarea name="meta_keyword" rows="3" class="form-control">{{$post->meta_keyword}}</textarea>
                </div>

                <div class="row my-4">
                    <div class="col-md-6">
                        <label for="">Status</label>
                        <input type="checkbox" {{$post->status == '1' ? 'checked' : ''}} name="status">
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
    
    
</div>

@endsection
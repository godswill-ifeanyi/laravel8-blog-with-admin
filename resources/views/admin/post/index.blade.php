@extends('layouts.master')

@section('content')

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/delete-post') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Post Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="post_id" id="post_id">
                <p>Are you sure to delete this post?</p>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <h4 class="mt-4">Posts</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">View Posts</li>
    </ol> 

    <div class="card mt-4">
        <div class="card-header">
            <h4>
                <a href="{{url('admin/add-post')}}" class="btn btn-success btn-sm float-end">Add Post</a>
            </h4>
        </div>

        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <table class="responsive">
                <table id="myTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Post Name</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($post as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->category->name}}</td>
                                <td>
                                    <img src="{{ asset('uploads/post/'. $item->image_path) }}" width="70px" alt="Post Img">
                                </td>
                                <td>{{$item->status == "1" ? "Visible" : "Hidden"}}</td>
                                <td>
                                    <a href="{{ url('admin/edit-post/'.$item->id) }}" class="btn btn-warning text-white">Edit</a>
                                </td>
                                <td>
                                    {{-- <a href="{{ url('admin/delete-category/'.$item->id) }}" class="btn btn-danger">Delete</a> --}}
                                    <button type="button" class="btn btn-danger deletePostBtn" value="{{$item->id}}">Delete</button>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </table>

        </div>
    </div>
     
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        /* $('.deleteCategoryBtn').click(function (e) {  */
            $(document).on('click', '.deletePostBtn', function (e) {

            e.preventDefault();
            
            var post_id = $(this).val();
            $('#post_id').val(post_id);
            $('#deleteModal').modal('show'); 
        });
    });
</script>
@endsection
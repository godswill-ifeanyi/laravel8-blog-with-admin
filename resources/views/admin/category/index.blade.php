@extends('layouts.master')

@section('content')

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/delete-category') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Category Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="category_id" id="category_id">
                <p>Are you sure to delete this category and all associated posts?</p>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <h4 class="mt-4">Category</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">View Category</li>
    </ol> 

    <div class="card mt-4">
        <div class="card-header">
            <h4>
                <a href="{{url('admin/add-category')}}" class="btn btn-success btn-sm float-end">Add Category</a>
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
                            <th>Category Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($category as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>
                                    <img src="{{ asset('uploads/category/'. $item->image_path) }}" width="70px" alt="Category Img">
                                </td>
                                <td>{{$item->admin_status == "1" ? "Visible" : "Hidden"}}</td>
                                <td>
                                    <a href="{{ url('admin/edit-category/'.$item->id) }}" class="btn btn-warning text-white">Edit</a>
                                </td>
                                <td>
                                    {{-- <a href="{{ url('admin/delete-category/'.$item->id) }}" class="btn btn-danger">Delete</a> --}}
                                    <button type="button" class="btn btn-danger deleteCategoryBtn" value="{{$item->id}}">Delete</button>
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
            $(document).on('click', '.deleteCategoryBtn', function (e) {

            e.preventDefault();
            
            var category_id = $(this).val();
            $('#category_id').val(category_id);
            $('#deleteModal').modal('show'); 
        });
    });
</script>
@endsection
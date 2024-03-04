@extends('layouts.master')

@section('content')

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ url('admin/delete-user') }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">User Delete</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="user_id">
                <p>Are you sure to delete this user?</p>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <h4 class="mt-4">Users</h4>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">All Users</li>
    </ol> 

    <div class="card card-body mt-4">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <table class="responsive">
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User's Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>
                                <form action="{{ url('admin/edit-user') }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$item->id}}">
                                    <select name="role_as" class="form-control">
                                        <option {{$item->role_as == '1' ? 'selected' : ''}} value="1">Admin</option>
                                        <option {{$item->role_as == '0' ? 'selected' : ''}} value="0">User</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary my-3 ">Save</button>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger deleteUserBtn" value="{{$item->id}}">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </table>

    </div>
     
</div>

@endsection

@section('script')
<script>
    $(document).ready(function () {
        /* $('.deleteCategoryBtn').click(function (e) {  */
            $(document).on('click', '.deleteUserBtn', function (e) {

            e.preventDefault();
            
            var user_id = $(this).val();
            $('#user_id').val(user_id);
            $('#deleteModal').modal('show'); 
        });
    });
</script>
@endsection
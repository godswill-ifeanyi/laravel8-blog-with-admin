@extends('layouts.master')

@section('content')

<div class="container-fluid px-4">
    <div class="row mt-4">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <h4>Website Settings</h4>
                </div>

                <div class="card-body">
                    <form action="{{url('admin/settings')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="">Website Name</label>
                            <input type="text" name="website_name" value="{{$setting == true ? $setting->website_name : " " }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="">Website Logo</label>
                            <input type="file" name="website_logo"  class="form-control mb-3" >
                            @if ($setting)
                                <img src="{{asset('uploads/setting/'.$setting->logo)}}" width="70px" height="70px" alt="Logo">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="">Website Favicon</label>
                            <input type="file" name="website_favicon" class="form-control mb-3" >
                            @if ($setting)
                                <img src="{{asset('uploads/setting/'.$setting->favicon)}}" width="70px" height="70px" alt="Favicon">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="">Description</label>
                            <textarea name="description" rows="3" class="form-control">{{$setting == true ? $setting->description : " " }}</textarea>
                        </div>

                        <h4>SEO Tags</h4>
                        <div class="mb-3">
                            <label for="">Meta Title</label>
                            <input type="text" name="meta_title" value="{{$setting == true ? $setting->meta_title : " " }}" class="form-control" >
                        </div>
                        <div class="mb-3">
                            <label for="">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3">{{$setting == true ? $setting->meta_description : " " }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Meta Keyword</label>
                            <textarea name="meta_keyword" class="form-control" rows="3">{{$setting == true ? $setting->meta_keyword : " " }}</textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
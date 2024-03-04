@extends('layouts.app') 

@section('title', $post->meta_title.' - Good Design')

@section('meta_description', $post->meta_description)

@section('meta_keyword', $post->meta_keyword)

@section('content')
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <form action="{{ url('admin/delete-category') }}" id="deleteForm" method="POST">
              @csrf
              @method('DELETE')

              <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Comment Delete</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <input type="hidden" name="comment_id" id="comment_id">
              <p>Are you sure to delete this comment?</p>
              </div>
              <div class="modal-footer">
              <button type="submit" class="btn btn-danger">Continue</button>
              </div>
          </form>
      </div>
  </div>
</div>

<section class="single-post-content mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-9 post-content" data-aos="fade-up">

          <!-- ======= Single Post Content ======= -->
          <div class="single-post">
            <div class="post-meta"><span class="date">{{$category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{$post->created_at->format('d-m-Y')}}</span></div>
            <h1 class="mb-5">{{$post->name}}</h1>

            <div class="card card-body">
                <img src="{{asset('uploads/post/'.$post->image_path)}}" alt="" class="img-fluid">
                <p>{{$post->name}} Image</p>
            </div>
            <div class="mt-3">
                <p>{!! $post->description !!}</p>
            </div>
            
            </div><!-- End Single Post Content -->

            <!-- ======= Comments Form ======= -->
          <div class="row justify-content-center mt-5">
            @if (session('message'))
                <div class="alert alert-warning" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <div id="messageContainer"></div>

            <div class="col-lg-12">
              <h5 class="comment-title">Leave a Comment</h5>
              <div class="row">
                <form action="{{url('comments')}}" method="POST">
                    @csrf

                    <input type="hidden" name="post_slug" value="{{$post->slug}}">

                    <div class="col-12 mb-3">
                    <label for="comment-message">Message</label>

                    <textarea class="form-control" name="comment_body" id="comment-message" placeholder="Enter your comment" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12">
                    <input type="submit" class="btn btn-primary" value="Post comment">
                    </div>
                </form>
              </div>
            </div>
          </div><!-- End Comments Form -->

          <!-- ======= Comments ======= -->
          <div class="comments" id="commentContainer">
            @php
                $comment_count = App\Models\Comment::where('post_id',$post->id)->count();
            @endphp
            <h5 class="comment-title py-4">{{$comment_count}} Comments</h5>

            @forelse ($post->comments as $comment)
            <div class="comment d-flex mb-5">
              <div class="flex-shrink-0">
                <div class="avatar avatar-sm rounded-circle">
                  <img class="avatar-img" src="{{asset('assets/img/male-avater.png')}}" alt="" class="img-fluid">
                </div>
              </div>
              <div class="flex-grow-1 ms-2 ms-sm-3">
                <div class="comment-meta d-flex align-items-baseline">
                  <h6 class="me-2">
                    @if ($comment->user)
                        {{$comment->user->name}}
                    @endif
                  </h6>
                  <span class="text-muted">{{$comment->created_at->format('d-m-Y')}}</span>
                </div>
                <div class="comment-body">
                  {!! $comment->comment_body !!}
                </div>
                @if (Auth::check() && Auth::user()->id == $comment->user_id)
                <div class="mt-3">
                  <a href="" class="btn btn-primary btn-sm me-2">Edit</a>

                  <button type="button" value="{{$comment->id}}" class="btn btn-danger btn-sm me-2 deleteComment">Delete</button>
                </div>
                @endif
              </div>
            </div>
            @empty
            <h6>No Comments Yet.</h6>
            @endforelse

          </div><!-- End Comments -->

        </div>
        <div class="col-md-3">
          <!-- ======= Sidebar ======= -->
          <div class="aside-block">

            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill" data-bs-target="#pills-popular" type="button" role="tab" aria-controls="pills-popular" aria-selected="true">Latest</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill" data-bs-target="#pills-trending" type="button" role="tab" aria-controls="pills-trending" aria-selected="false">Trending</button>
              </li>
            </ul>

            <div class="tab-content" id="pills-tabContent">

              <!-- Latest -->
              <div class="tab-pane fade show active" id="pills-popular" role="tabpanel" aria-labelledby="pills-popular-tab">
                
                @foreach ($latest_posts as $latest_post_item)
                    
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">{{$category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{$latest_post_item->created_at->format('d-m-Y')}}</span></div>
                  <h2 class="mb-2"><a href="{{url($latest_post_item->category->slug.'/'.$latest_post_item->slug)}}">{{$latest_post_item->name}}</a></h2>
                  <span class="author mb-3 d-block">{{$latest_post_item->user->name}}</span>
                </div>

                @endforeach

              </div> <!-- End Popular -->

              <!-- Trending -->
              <div class="tab-pane fade" id="pills-trending" role="tabpanel" aria-labelledby="pills-trending-tab">
                <div class="post-entry-1 border-bottom">
                  <div class="post-meta"><span class="date">Lifestyle</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2 class="mb-2"><a href="#">17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</a></h2>
                  <span class="author mb-3 d-block">Jenny Wilson</span>
                </div>

              </div> <!-- End Trending -->

            </div>
          </div>

          <div class="aside-block">
            <h3 class="aside-title">Video</h3>
            <div class="video-post">
              <a href="{{$latest_post_item->yt_iframe}}" class="glightbox link-video">
                <span class="bi-play-fill"></span>
                <img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Video -->

          <div class="aside-block">
            <h3 class="aside-title">Tags</h3>
            <ul class="aside-tags list-unstyled">
              <li><a href="category.html">{{$latest_post_item->meta_keyword}}</a></li>
            </ul>
          </div><!-- End Tags -->

        </div>
      </div>
    </div>
  </section>
@endsection

@section('script')
    <script>
      $(document).ready(function () {

        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        
        $(document).on('click', '.deleteComment', function (e) {
          e.preventDefault();
            
          var thisClicked = $(this);
            var comment_id = thisClicked.val();
            $('#comment_id').val(comment_id);
            $('#deleteModal').modal('show');  
            
            $('#deleteForm').submit(function (e) { 
              $('#deleteModal').modal('hide');
              
              e.preventDefault();

              $.ajax({
                type: "DELETE",
                url: "/delete-comment",
                data: {
                  "comment_id" : comment_id
                },
                success: function (res) {
                  if (res.status == 200) {

                    $("#commentContainer").load(location.href + " #commentContainer");
                    //thisClicked.closest('#commentContainer').remove();

                    var messageContainer = document.getElementById('messageContainer');
                    messageContainer.classList.add('alert');
                    messageContainer.classList.add('alert-warning');
                    messageContainer.append(res.message);
                  }
                  else {
                    alert(res.message);
                  }
                }
              });
              
            });
            
        });
      });
    </script>
@endsection


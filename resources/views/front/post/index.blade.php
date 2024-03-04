@extends('layouts.app') 

@section('title',$category->meta_title.' - Good Design')

@section('meta_description',$category->meta_description)

@section('meta_keyword',$category->meta_keyword)

@section('content')
<section class="category-section mt-5">
    <div class="container" data-aos="fade-up">

      <div class="section-header d-flex justify-content-between align-items-center mb-5">
        <h2>{{$category->name}}</h2>
      </div>

      <div class="row">
        <div class="col-md-9">

          <div class="d-lg-flex post-entry-2">
            <span class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
              <img src="{{asset('uploads/category/'.$category->image_path)}}" alt="" class="img-fluid w-100">
            </span>
            <div>
              
              <h3>{{$category->name}}</h3>
              <p>{{$category->description}}</p>
              <div class="d-flex align-items-center author">
                <div class="photo"><i>Created By:</i></div>
                <div class="name">
                  <h3 class="m-0 p-0">{{$category->user->name}}</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
         @forelse ($post as $postitem)
         <div class="post-entry-1 border-bottom">
            <div class="post-meta"><span class="date">Blog</span> <span class="mx-1">&bullet;</span> <span>{{$postitem->created_at->format('d-m-Y')}}</span></div>
            <h2 class="mb-2"><a href="{{url($category->slug.'/'.$postitem->slug)}}">{{$postitem->name}}</a></h2>
            <span class="author mb-3 d-block">{{$postitem->user->name}}</span>
          </div>
          
         @empty
             <div class="card card-shadow">
                <div class="card-body">
                    <h3>No Posts Available</h3>
                </div>
             </div>
         @endforelse
         <div class="your-paginate mt-3">
            {{$post->links()}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection


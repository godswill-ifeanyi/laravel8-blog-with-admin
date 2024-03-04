@extends('layouts.app') 

@section('title','Good Design Blog Website')

@section('meta_description','Good Design Blog Website')

@section('meta_keyword','Good Design Blog Website')

@section('content')
<section id="hero-slider" class="hero-slider">
  <div class="container-md" data-aos="fade-in">
    <div class="card card-body mt-4">
      @if (session('status'))
          <div class="alert alert-danger" role="alert">
              {{ session('status') }}
          </div>
      @endif
      @if (session('message'))
          <div class="alert alert-success" role="alert">
              {{ session('message') }}
          </div>
      @endif
    </div>
    <div class="row">
      <div class="col-12">
        <div class="swiper sliderFeaturedPosts">
          <div class="swiper-wrapper">

            @foreach ($category as $cateitem)
            <div class="swiper-slide">
              <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('uploads/category/{{$cateitem->image_path}}');">
                <div class="img-bg-inner">
                  <h2>{{$cateitem->name}}</h2>
                  <p>{{$cateitem->description}}</p>
                </div>
              </a>
            </div>
            @endforeach

          </div>
          <div class="custom-swiper-button-next">
            <span class="bi-chevron-right"></span>
          </div>
          <div class="custom-swiper-button-prev">
            <span class="bi-chevron-left"></span>
          </div>

          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Slider Section -->


<!-- ======= Business Category Section ======= -->
<section class="category-section">
  <div class="container" data-aos="fade-up">

    <div class="section-header d-flex justify-content-between align-items-center mb-5">
      <h2>Blogs</h2>
    </div>

    <div class="row">
      <div class="col-md-9 order-md-2">

        <div class="d-lg-flex post-entry-2">
          <a href="single-post.html" class="me-4 thumbnail d-inline-block mb-4 mb-lg-0">
            <img src="{{ asset('assets/img/post-landscape-3.jpg') }}" alt="" class="img-fluid"><br><br>
            <img src="{{ asset('assets/img/post-landscape-7.jpg') }}" alt="" class="img-fluid">
          </a>
          <div>
            
            <div class="post-meta"><span class="date">Trending</span> <span class="mx-1">&bullet;</span> <span>{{date('d-m-Y')}}</span></div>
            <h3><a href="single-post.html">What is the son of Football Coach John Gruden, Deuce Gruden doing Now?</a></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?</p>
            <div class="d-flex align-items-center author">
              <div class="photo"><img src="{{ asset('assets/img/person-4.jpg') }}" alt="" class="img-fluid"></div>
              <div class="name">
                <h3 class="m-0 p-0">Wade Warren</h3>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-3">
        @foreach ($post as $item)
            
        <div class="post-entry-1 border-bottom">
          <div class="post-meta"><span class="date">Latest</span> <span class="mx-1">&bullet;</span> <span>{{$item->created_at->format('d-m-Y')}}</span></div>
          <h2 class="mb-2"><a href="{{$item->slug}}">{{$item->name}}</a></h2>
          <span class="author mb-3 d-block"><i>By:</i> {{$item->user->name}}</span>
        </div>

        @endforeach

      </div>
    </div>
  </div>
</section><!-- End Business Category Section -->

@endsection


<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
<div class="container-fluid container-xl d-flex align-items-center justify-content-between">

    <a href="{{url('/')}}" class="logo d-flex align-items-center">

        @php
            $setting = App\Models\Setting::find(1); 
        @endphp
    <img src="{{ asset('uploads/setting/'.$setting->logo) }}" alt=""> 
    <h4>Good Design</h4>
    </a>

    <nav id="navbar" class="navbar">
        @php
            $category = App\Models\Category::where('front_status','1')->where('admin_status','1')->get();
        @endphp
    <ul>
        @foreach ($category as $cateitem)
        <li><a href="{{url('category/'.$cateitem->slug)}}">{{$cateitem->name}}</a></li>
        @endforeach
        
        <li class="dropdown"><a href="#"><span>Blogs</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
        @php
        $post = App\Models\Post::where('status','1')->orderBy('created_at','DESC')->get();
        $post_group = $post->groupBy(function($item,$key) {
            return $item->created_at->format('d-m-Y');
        })
        @endphp
        <ul>
           @foreach ($post_group as $date_group)

            <li class="dropdown"><a href="#"><span>{{$date_group->first()->created_at->format('d-m-Y')}}</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
                @foreach ($date_group as $item)
                <li><a href="{{url($item->category->slug.'/'.$item->slug)}}">{{$item->name}}</a></li>
                @endforeach
                
            </ul>
            </li>

            @endforeach
        </ul>
        </li>

        @if (Auth::check())
        <li style="border: 1px solid black; border-radius: 50px; padding-right: 25px; margin-left: 20px;">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>    
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </li>  
        @else
        <li style="border: 1px solid black; border-radius: 50px; padding-right: 25px; margin-left: 20px;"><a href="{{url('/login')}}">Login</a></li>
        <li style="border: 1px solid black; border-radius: 50px; padding-right: 25px; margin-left: 20px;"><a href="{{url('/register')}}">Register</a></li>
        @endif
        
    </ul>
    </nav><!-- .navbar -->

    <div class="position-relative">
    <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
    <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
    <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

    <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
    <i class="bi bi-list mobile-nav-toggle"></i>

    <!-- ======= Search Form ======= -->
    <div class="search-form-wrap js-search-form-wrap">
        <form action="search-result.html" class="search-form">
        <span class="icon bi-search"></span>
        <input type="text" placeholder="Search" class="form-control">
        <button class="btn js-search-close"><span class="bi-x"></span></button>
        </form>
    </div><!-- End Search Form -->

    </div>

</div>

</header><!-- End Header -->
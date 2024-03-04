<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">

        @php
            $setting = App\Models\Setting::find(1);
        @endphp

        <div class="row">
          <div class="col-md-5">
            <h3 class="footer-heading">About {{$setting->website_name}}</h3>
            <p>{{$setting->description}}</p>
          </div>

          @php
            $category = App\Models\Category::where('front_status','1')->where('admin_status','1')->get();
          @endphp

          <div class="col-md-3">
            <h3 class="footer-heading">Categories</h3>
            <ul class="footer-links list-unstyled">
              @foreach ($category as $cateitem)
              <li><a href="{{url('category/'.$cateitem->slug)}}"><i class="bi bi-chevron-right"></i> {{$cateitem->name}}</a></li>
              @endforeach
            </ul>
          </div>

          @php
          $post = App\Models\Post::where('status','1')->take(4)->get();
          @endphp

          <div class="col-md-4">
            <h3 class="footer-heading">Recent Posts</h3>

            <ul class="footer-links footer-blog-entry list-unstyled">
              
              @foreach ($post as $postitem)
              @php
                $category = App\Models\Category::where('front_status','1')->where('admin_status','1')->get();
              @endphp
              <li>
                @foreach ($category as $cateitem)
                <a href="{{url($cateitem->slug.'/'.$postitem->slug)}}" class="d-flex align-items-center">    
                @endforeach              
                  <img src="{{ asset('uploads/post/'.$postitem->image_path) }}" alt="" class="img-fluid me-3">
                  <div>
                    <div class="post-meta d-block"><span class="date">{{$postitem->category->name}}</span> <span class="mx-1">&bullet;</span> <span>{{$postitem->created_at->format('d-m-Y')}}</span></div>
                    <span>{{$postitem->name}}</span>
                  </div>
                </a>
              </li>
              @endforeach

            </ul>

          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>{{$setting->website_name}}</span></strong>. All Rights Reserved
            </div>

            <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
              Designed by <a href="https://gooddesign.com.ng/">{{$setting->website_name}}</a>
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

</footer>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--Favicon-->
    @php
        $setting = App\Models\Setting::find(1);
    @endphp
    <link href="{{ asset('uploads/setting/'.$setting->favicon) }}" rel="icon">

    <!-- Styles -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!--Summernote CSS link-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
</head>
<body>
    @include('includes.admin-navbar')

    <div id="layoutSidenav">
        @include('includes.admin-side-nav')

        <div id="layoutSidenav_content">
            <main>

                @yield('content')

            </main>

            @include('includes.admin-footer')
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}" ></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" ></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>

    <!--Summernote JS Link-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#mySummernote").summernote({
                height: 150,
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    
    <script>
        let table = new DataTable('#myTable');
    </script>

    @yield('script')
</body>    
</html>
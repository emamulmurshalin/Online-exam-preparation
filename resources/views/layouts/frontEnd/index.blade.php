
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Online exam preparation | Home</title>
    <!-- meta-tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Soft Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <!-- //meta-tags -->
    <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
    <link href="{{asset('front/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('front/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- font-awesome -->
    <link href="{{asset('front/css/font-awesome.css')}}" rel="stylesheet">
    <!-- fonts -->
    <link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
</head>

<body>

<div class="wrapper" id="app">
    <!-- header -->
@include('layouts.frontEnd.includes.top-navbar')

@include('layouts.frontEnd.includes.top-menu')

@yield('content')
<!-- footer -->
@include('layouts.frontEnd.includes.footer')
<!--/footer -->
</div>


<script src="{{asset('front/js/jquery-2.1.4.min.js')}}"></script>

<script src="{{asset('front/js/bootstrap.js')}}"></script>
<script src="{{asset('front/js/numscroller-1.0.js')}}"></script>

<script>
    $(window).load(function () {
        $("#flexiselDemo1").flexisel({
            visibleItems: 1,
            animationSpeed: 1000,
            autoPlay: false,
            autoPlaySpeed: 3000,
            pauseOnHover: true,
            enableResponsiveBreakpoints: true,
            responsiveBreakpoints: {
                portrait: {
                    changePoint: 480,
                    visibleItems: 1
                },
                landscape: {
                    changePoint: 640,
                    visibleItems: 1
                },
                tablet: {
                    changePoint: 768,
                    visibleItems: 1
                }
            }
        });

    });
</script>
<script src="{{asset('front/js/jquery.flexisel.js')}}"></script>
{{--<script src="{{asset('front/js/SmoothScroll.min.js')}}"></script>--}}
<script src="{{asset('front/js/move-top.js')}}"></script>
<script src="{{asset('front/js/easing.js')}}"></script>
<!-- here stars scrolling icon -->
<script>
    $(document).ready(function () {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
</script>

@auth()
    <script>
        window.user = @json(auth()->user())
    </script>
@endauth
</body>

</html>

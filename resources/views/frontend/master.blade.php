<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{settings('app_name')}}</title>
    <link rel="stylesheet" href="{{asset('/')}}assets/frontend/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('/')}}assets/frontend/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" integrity="sha512-Velp0ebMKjcd9RiCoaHhLXkR1sFoCCWXNp6w4zj1hfMifYB5441C+sKeBl/T/Ka6NjBiRfBBQRaQq65ekYz3UQ==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('/')}}assets/frontend/css/style.css">
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
        <a href="{{asset('/')}}" class="navbar-brand">{{settings('app_name')}}</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                    <a href="{{asset('/')}}" class="nav-link">Home {{request()->is(asset('/'))}}</a>
                </li>
                <li class="nav-item {{ request()->is('about-us') ? 'active' : '' }}">
                    <a href="{{asset('/about-us')}}" class="nav-link">About Us</a>
                </li>
                <li class="nav-item {{ request()->is('package') ? 'active' : '' }}">
                    <a href="{{asset('/package')}}" class="nav-link">Package</a>
                </li>
                <li class="nav-item {{ request()->is('contact') ? 'active' : '' }}">
                    <a href="{{asset('/contact')}}" class="nav-link">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


@yield('content')


<!-- footer -->
<footer id="main-footer" class="text-center p-4">
    <div class="container">
        <div class="row">
            <div class="col">
                <p>Copyright &copy; <span id="year"></span> {{settings('app_name')}}</p>
            </div>
        </div>
    </div>
</footer>



<!-- video modal -->
<div class="modal fade" id="videoModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
                <iframe src="" frameborder="0" height="350" width="100%" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>


<script src="{{asset('/')}}assets/frontend/js/jquery-3.4.1.js"></script>
<script src="{{asset('/')}}assets/frontend/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js" integrity="sha512-Y2IiVZeaBwXG1wSV7f13plqlmFOx8MdjuHyYFVoYzhyRr3nH/NMDjTBSswijzADdNzMyWNetbLMfOpIPl6Cv9g==" crossorigin="anonymous"></script>
<script>
    //get the current year for the copyright
    $('#year').text(new Date().getFullYear());

    //configure slider
    $('.carousel').carousel({
        interval: 6000,
        pause: 'hover'
    });

    //lightbox init
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    // Video Play
    $(function () {
        // Auto play modal video
        $(".video").click(function () {
            var theModal = $(this).data("target"),
                videoSRC = $(this).attr("data-video"),
                videoSRCauto = videoSRC + "?modestbranding=1&rel=0&controls=0&showinfo=0&html5=1&autoplay=1";
            $(theModal + ' iframe').attr('src', videoSRCauto);
            $(theModal + ' button.close').click(function () {
                $(theModal + ' iframe').attr('src', videoSRC);
            });
        });
    });
</script>
</body>
</html>

@extends('frontend.master')
@section('content')
    <!-- showcase slider -->
    <section id="showcase">
        <div id="myCarousel" class="carousel slider" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                @foreach($sliders as $key => $slider)
                <div class="carousel-item {{$key==0?'active' : ''}}">
                    <img src="{{getImage(imagePath()['slider']['path'] . '/' . $slider->image, imagePath()['slider']['size'])}}" class="carousel-slider d-block w-100" alt="">
                    <div class="container">
                        <div class="carousel-caption d-none d-sm-block text-right mb-5">
                            <h1 class="display-3">{{$slider->heading}}</h1>
                            <p class="lead">{{$slider->title}}</p>
                        </div>
                    </div>
                </div>
                @endforeach

                    Home Internet Solution Keep peace with ISP

{{--                <div class="carousel-item">--}}
{{--                    <img src="{{asset('/')}}assets/frontend/img/image2.jpg" class="carousel-slider d-block w-100" alt="">--}}
{{--                    <div class="container">--}}
{{--                        <div class="carousel-caption d-none d-sm-block mb-5">--}}
{{--                            <h1 class="display-3">Home Internet Solution</h1>--}}
{{--                            <p class="lead">Keep peace with ISP</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="carousel-item ">--}}
{{--                    <img src="{{asset('/')}}assets/frontend/img/image3.jpg" class="carousel-slider d-block w-100" alt="">--}}
{{--                    <div class="container">--}}
{{--                        <div class="carousel-caption d-none d-sm-block mb-5">--}}
{{--                            <h1 class="display-3">Small or Medium Boost Your Business with us</h1>--}}
{{--                            <p class="lead">ISP is passionate about fuelling your growth.</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

            <a href="#myCarousel" data-slide="prev" class="carousel-control-prev">
                <span class="carousel-control-prev-icon"></span>
            </a>

            <a href="#myCarousel" data-slide="next" class="carousel-control-next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </section>



    <!-- home icon section -->
    <section id="home-icons" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 text-center">
                    <i class="fas fa-home fa-3x mb-2"></i>
                    <h3>Home Broadband Internet</h3>
                    <p>ISP is providing one of the fastest broadband internet and network solutions throughout Dhaka, reliable for both gamers and regular users.</p>
                </div>
                <div class="col-md-4 mb-4 text-center">
                    <i class="fas fa-handshake fa-3x mb-2"></i>
                    <h3>Corporate/SME Internet</h3>
                    <p>Offering dedicated internet connection with various network solutions ensuring network stability for our Corporate and SME consumers. Along with a support manager for 24/7 response.</p>
                </div>
                <div class="col-md-4 mb-4 text-center">
                    <i class="fas fa-network-wired fa-3x mb-2"></i>
                    <h3>Network Solutions</h3>
                    <p>ISP provides both LAN & WAN networks solutions. With the help of our experienced network engineers, we ensure the most efficient Network solutions for our clients.</p>
                </div>
            </div>
        </div>
    </section>



    <!-- home heading section -->
    <section id="home-heading" class="p-5">
        <div class="dark-overlay">
            <div class="row">
                <div class="col">
                    <div class="container pt-5">
                        <h1>ISP Don’t Suffer The Buffer</h1>
                        <p class="d-none d-md-block">Secured internet connection with a fully dedicated network, you can watch anything without buffering.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- .info section -->
    <section id="info" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6 align-self-center">
                    <h3>BDIX Server</h3>
                    <p>Watch your favorite Movie with high speed movie server</p>
                    <a href="https://bdixftpserver.com/" class="btn btn-outline-danger btn-lg">Learn More</a>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('/')}}assets/frontend/img/laptop.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </section>





    <!-- newsletter -->
    <section id="newsletter" class="text-center p-5 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Sign Up For Our Newslwtter</h1>
                    <p>The latest news, articles, and resources, sent to your inbox weekly.</p>
                    <form class="form-inline justify-content-center">
                        <input type="text" class="form-control mb-2 mr-2" placeholder="Enter Name">
                        <input type="email" class="form-control mb-2 mr-2" placeholder="Enter Email">
                        <button class="btn btn-primary mb-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

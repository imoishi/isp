@extends('frontend.master')
@section('content')

    <!-- page header -->
    <header id="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto text-center">
                    <h1>About Us</h1>
                    <p>{{settings('about_short_info')}}</p>
                </div>
            </div>
        </div>
    </header>


    <!-- about section -->
    <section id="about" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>What We Do</h1>
                    <p>{{settings('about_long_info')}}</p>
                </div>
                <div class="col-md-6">
                    <img src="https://source.unsplash.com/random/700x700/?technology" alt="" class="img-fluid rounded-circle d-none d-md-block about-img">
                </div>
            </div>
        </div>
    </section>




@endsection

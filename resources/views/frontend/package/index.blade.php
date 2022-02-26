@extends('frontend.master')
@section('content')

    <header id="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto text-center">
                    <h1>Package</h1>
                    <p>Isp's package plans are flexible. Isp offers competitive rates and pricing plans to help you find one that fits your needs and budget.</p>
                </div>
            </div>
        </div>
    </header>

    <!-- services section -->
    <section id="services" class="py-5">
        <div class="container">
            <div class="row">
                @foreach($packages as $package)
                <div class="col-md-4 mb-3">
                    <div class="card text-center">
                        <div class="card-header bg-dark text-white">
                            <h3>{{$package->name}}</h3>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">&#2547; {{$package->price}}/Month</h4>
                            <p class="card-text">{{$package->description}}</p>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <i class="fas fa-check"></i> {{$package->value}}
                                </li>
                            </ul>
                            <a href="tel:{{settings('app_mobile')}}" class="btn btn-danger btn-block mt-2">Call Us</a>
                        </div>
                        <div class="card-footer text-muted">
                            Unlimited Internet
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

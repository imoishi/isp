@extends('frontend.master')
@section('content')
    <!-- page header -->
    <header id="page-header">
        <div class="container">
            <div class="row">
                <div class="col-md-6 m-auto text-center">
                    <h1>Contact Us</h1>
                    <p>If you would like to find out more about how we can help you, please give us a call or drop us an email. We welcome your comments and suggestions about this website and/or any other issues that you wish to raise.</p>
                </div>
            </div>
        </div>
    </header>



    <!-- contact section -->
    <section id="contact" class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-4">
                        <div class="card-body">
                            <h4>Get In Touch</h4>
                            <p>If you would like to find out more about how we can help you, please give us a call or drop us an email.</p>
                            <h4>Address</h4>
                            <p>{{settings('app_address')}}</p>
                            <h4>Email</h4>
                            <p>{{settings('app_email')}}</p>
                            <h4>Phone</h4>
                            <p>{{settings('app_mobile')}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card p-4">
                        <div class="card-body">
                            <h3 class="text-center">Please fill out this form to contact us</h3>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone Number">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="submit" value="Submit" class="btn btn-outline-danger btn-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@extends('admin.layouts.app')
@section('title') @lang('trans.dashboard') @endsection
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">@lang('trans.dashboard')</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
{{--                        <li class="breadcrumb-item active"><a href="{{url('/home')}}">Home</a></li>--}}
                        <li class="breadcrumb-item active">@lang('trans.dashboard')</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$dashboardData->totalBill}}</h3>
                            <p>Previous Month Total Bill</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$dashboardData->totalDue}}</h3>
                            <p>Previous Month Total Due</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money-bill-alt"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$dashboardData->totalExpense}}</h3>

                            <p>Previous Month Total Expense</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$dashboardData->totalPackage}}</h3>

                            <p>Total Package</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-shopping-bag"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>
        </div>
    </div>
@endsection

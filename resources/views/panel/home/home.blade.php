@extends('panel.master')
@section('title')
    XYZ POS Home
@endsection



@section('content')

    <!-- /.row -->
    <div class="row" style="padding-top: 85px;">
        <div class="col-lg-4 col-md-5">
            <a href="{{url('/products')}}">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$productCount}}</div>
                                <div class="text-uppercase">Products</div>
                            </div>
                        </div>
                    </div>


                </div>
            </a>

        </div>
        <div class="col-lg-4 col-md-5">
            <a href="{{url('/categories')}}">

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$categoryCount}}</div>
                                <div class="text-uppercase">Categories</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>

        </div>
        <div class="col-lg-4 col-md-5">
            <a href="{{url('/sales')}}">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$saleCount}}</div>
                                <div class="text-uppercase">Sales</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-5">
            <a href="{{url('/brands')}}">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-compass fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$brandCount}}</div>
                                <div class="text-uppercase">Brands</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-5">
            <a href="{{url('/customers/')}}">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$customerCount}}</div>
                                <div class="text-uppercase">Customers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-lg-4 col-md-5">
            <a href="{{url('/suppliers/')}}">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$supplierCount}}</div>
                                <div class="text-uppercase">Suppliers</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>


    </div>
    <!-- /.row -->
    @if (\Auth::user()->role_id != 2)
        <div class="row">
            <div class="col-md-12">
                <div style="margin: 60px auto 30px;">
                    <h2 class="text-center" style="font-weight: bolder;">Transaction of last 7 days</h2>
                    <div>
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        {!! $chart->script() !!}
    @endif


@endsection


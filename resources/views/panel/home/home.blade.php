@extends('panel.master')
@section('title')
    XYZ POS Home
@endsection



@section('content')

    <!-- /.row -->
    <div class="row" style="padding-top: 85px;">
        <div class="col-lg-4 col-md-5">
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
                <a href="{{url('/products')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-5">
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
                <a href="{{url('/categories')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-5">
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
                <a href="{{url('/sales')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-5">
            <div class="panel panel-yellow">
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
                <a href="{{url('/sales')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div><div class="col-lg-4 col-md-5">
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
                <a href="{{url('/customers/')}}">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>


    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div id="profitChart" style="width:100%; height:400px; margin: 90px auto;"></div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            //profit chart init
            Highcharts.chart('profitChart', {
                chart: {
                    type: 'areaspline'
                },
                title: {
                    text: 'Average Transition during one week'
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 150,
                    y: 100,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor)
                },
                exporting: { enabled: false },
                xAxis: {
                    categories: [
                        'Monday',
                        'Tuesday',
                        'Wednesday',
                        'Thursday',
                        'Friday',
                        'Saturday',
                        'Sunday'
                    ],
                    plotBands: [{ // visualize the weekend
                        from: 4.5,
                        to: 6.5,
                        color: 'rgba(68, 170, 213, .2)'
                    }]
                },
                yAxis: {
                    title: {
                        text: 'BDT(Taka)'
                    }
                },
                tooltip: {
                    shared: true,
                    valueSuffix: ' BDT'
                },
                credits: {
                    enabled: false
                },
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                series: [{
                    name: 'Expenditure',
                    data: [3000, 4000, 3000, 5000, 4000, 10000, 10002]
                }, {
                    name: 'Earnings',
                    data: [1000, 3000, 4000, 3000, 3000, 5000, 4000]
                }]
            });
        });
    </script>

@endsection


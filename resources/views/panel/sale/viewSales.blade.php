@extends('panel.master')
@section('content')
    <hr>
    <div class="container">
        <ul class="nav nav-pills">
            <li class="active"><a href="{{url('/sales/')}}">All Time</a></li>
            <li><a href="{{url('/sales/thismonth')}}">This Month</a></li>
            <li><a href="{{url('/sales/lastmonth')}}">Last Month</a></li>
            <li><a href="{{url('/sales/thisweek')}}">This Week</a></li>
            <li><a href="{{'/sales/lastweek'}}">Last Week</a></li>
            <li><a href="{{url('/sales/today')}}">Today</a></li>
        </ul>
    </div>
    <hr/>
    <div class="row" style="padding-top: 10px;">
        <div class="col-md-3">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$totalSaleCost[0]->totalBill}}</div>
                            <div class="text-uppercase">Total Sold BDT</div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-list fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">{{$totalCost[0]->totalCost}}</div>
                            <div class="text-uppercase">Total Buying BDT</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{url('/sales')}}">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$totalProfit}}</div>
                                <div class="text-uppercase">Total Profit BDT</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="{{url('/brands')}}">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-compass fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$profitPercentage}}%</div>
                                <div class="text-uppercase">Profit Percentage</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>



    </div>
    <h3 class="text-center text-success">
        @if(Session::get('successMessage'))
            {{Session::get('successMessage')}}
        @else
            Records of Sales
        @endif</h3>
    <hr/>


    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #4DB6AC; color: white;">
                <th>Invoice ID</th>
                <th>Customer Name</th>
                <th>Product Full Name</th>
                <th>Product Quantity</th>
                <th>Price Per Unit</th>
                <th>Total Bill</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                <tr>
                    <th scope="row">{{$sale->id }}</th>
                    <th>{{$sale->firstName }}</th>
                    <td>{{ $sale->productName }}</td>
                    <td>{{ $sale->purchaseQuantity }}</td>
                    <td>TK. {{ $sale->productSellingPrice }}</td>
                    <td>TK. {{ $sale->totalBill }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <hr/>
    <h3 class="text text-center text-success">Summery</h3>
    <hr/>
    <h3>Overall</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #4DB6AC; color: white;">
                <th>Total Customers</th>
                <th>Total Products Sold</th>
                <th>Total Buying Cost</th>
                <th>Total Selling Cost</th>
                <th>Total Profit</th>
                <th>Profit Percentage</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th>{{$totalCustomers}}</th>
                <th>{{$totalProductsSold[0]->totalSold}}</th>
                <th>TK. {{$totalCost[0]->totalCost}}</th>
                <th>TK. {{$totalSaleCost[0]->totalBill}}</th>
                <th>TK. {{$totalProfit}}</th>
                <th>{{$profitPercentage}}% (±0.5)</th>
            </tr>
            </tbody>
        </table>
        <hr/>
        <h3>Top Customers by Expense</h3>
        <table class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #4DB6AC; color: white;">
                <th>Customer Full Name</th>
                <th>Customer Expense</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topCustomersByExpense as $topCustomerByExpense)
                <tr>
                    <th>{{$topCustomerByExpense->firstName." ".$topCustomerByExpense->lastName}}</th>
                    <th>{{$topCustomerByExpense->totalExpense}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
        <h3>Top Customers by Product Quantity</h3>
        <table class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #4DB6AC; color: white;">
                <th>Customer Full Name</th>
                <th>Products Bought</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topCustomersByProductQt as $topCustomerByProductQt)
                <tr>
                    <th>{{$topCustomerByProductQt->firstName." ".$topCustomerByProductQt->lastName}}</th>
                    <th>{{$topCustomerByProductQt->totalQuantity}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
        <hr/>
        <h3>Top Selling Products</h3>
        <table class="table table-bordered table-hover">
            <thead>
            <tr style="background-color: #4DB6AC; color: white;">
                <th>Product Name</th>
                <th>Product Category</th>
                <th>Total Sold</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topSellingProducts as $topSellingProduct)
                <tr>
                    <th>{{$topSellingProduct->productName}}</th>
                    <th>{{$topSellingProduct->categoryNamee}}</th>
                    <th>{{$topSellingProduct->sellingQuantity}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
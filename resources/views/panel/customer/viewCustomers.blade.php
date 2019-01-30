@extends('panel.master')
@section('content')
    <hr>
    <div class="container">
        <div class="col-lg-11">
            {!! Form::open( [ 'url'=>'customer/do/', 'method' =>'get', 'class' =>'form-horizontal', 'role'=>'search' ] ) !!}
            <div class="input-group add-on form-group">
                <input class="form-control" placeholder="Find Customer with Phone Number..." name="customerPhone"
                       id="srch-term"
                       type="number">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
    <hr>
    <h3 class="text-center text-success">{{Session::get('msg')}}
        @if(Session::get('successMsg'))
            {{Session::get('successMsg')}}
        @else
            {{$firstMsg}}
        @endif</h3>
    </h3>
    <hr>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Total Products Bought</th>
            <th>Total Purchase (BDT)</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($customers as $customer)
            <tr>
                <td>{{$customer->id}}</td>
                <td><a href="{{ url('/customer/'.$customer->phoneNumber) }}">{{$customer->firstName}}</a></td>
                <td>{{$customer->lastName}}</td>
                <td><a href="{{ url('/customer/'.$customer->phoneNumber) }}">{{$customer->phoneNumber}}</a></td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->address}}</td>
                <td>{{$customer->totalProductsBought}}</td>
                <td>{{$customer->totalPurchasedBDT}}</td>
                <td>
                    <a href="{{ url('/customer/edit/'.$customer->phoneNumber) }}" class="btn btn-success"
                       title="Edit Customer">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('/customer/'.$customer->phoneNumber) }}" class="btn btn-success"
                       title="Sell Product to Customer">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
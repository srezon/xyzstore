

@extends('panel.master')
@section('content')
    <hr>
    
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
            <th>Total Purchase</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{$customerByPhone->id}}</td>
                <td>{{$customerByPhone->firstName}}</td>
                <td>{{$customerByPhone->lastName}}</td>
                <td>{{$customerByPhone->phoneNumber}}</td>
                <td>{{$customerByPhone->email}}</td>
                <td>{{$customerByPhone->address}}</td>
                <td>{{$customerByPhone->totalPurchaseBDT}}</td>
                <td>
                    <a href="{{ url('/customer/edit/'.$customerByPhone->phoneNumber) }}" class="btn btn-success" title="Edit Customer">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                     <a href="{{ url('/customer/'.$customerByPhone->phoneNumber) }}" class="btn btn-success" title="Sell Product to Customer">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

<hr>

    <div class="container">
        <div class="col-lg-11">
            {!! Form::open( [ 'url'=>'sale/do/', 'method' =>'get', 'class' =>'form-horizontal', 'role'=>'search' ] ) !!}
            <div class="input-group add-on form-group">
                <input class="form-control" placeholder="Enter Product Code to sell to this Customer....." name="productID" id="srch-term"
                       type="number">
                <input type="hidden" value="{{ $customerByPhone->phoneNumber }}" class="form-control" placeholder="Enter Customer ID to find them..."
                       name="customerPhone" id="srch-term" type="number">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
    <hr>
    
@endsection
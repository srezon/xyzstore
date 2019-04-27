@extends('panel.master')
@section('content')
    <hr>
    <div class="container">
        <div class="col-lg-11">
            {!! Form::open( [ 'url'=>'customer/do/', 'method' =>'get', 'class' =>'form-horizontal', 'role'=>'search' ] ) !!}
            <div class="input-group add-on form-group">
                <input class="form-control" placeholder="Find Customer with Phone Number..." name="customerPhone"
                       id="srch-term" type="number" required>
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
            {{ $customerByPhone ? $firstMsg.$customerByPhone->customerPrimaryContact : ''}}
        @endif</h3>
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
        @if (!empty($customerByPhone))
            <tr>

                <td>{{$customerByPhone->id}}</td>
                <td><a href="{{ url('/customer/'.$customerByPhone->phoneNumber) }}">{{$customerByPhone->firstName}}</a>
                </td>
                <td>{{$customerByPhone->lastName}}</td>
                <td>
                    <a href="{{ url('/customer/'.$customerByPhone->phoneNumber) }}">{{$customerByPhone->phoneNumber}}</a>
                </td>
                <td>{{$customerByPhone->email}}</td>
                <td>{{$customerByPhone->address}}</td>
                <td>{{$customerByPhone->totalProductsBought}}</td>
                <td>{{$customerByPhone->totalPurchasedBDT}}</td>
                <td>
                    <a href="{{ url('/customer/edit/'.$customerByPhone->phoneNumber) }}" class="btn btn-success"
                       title="Edit Customer">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('/customer/'.$customerByPhone->phoneNumber) }}" class="btn btn-success"
                       title="Sell Product to Customer">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                    </a>
                </td>
            <tr>

        @else
            <tr>
                <td colspan="9" align="center" style="background-color: #e8d9d8">No records found!</td>
            </tr>
        @endif
        </tbody>
    </table>
    <hr>
    <hr>
@endsection
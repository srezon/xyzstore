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
            {{$firstMsg.$customerByPhone->customerPrimaryContact}}
        @endif</h3>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Total Purchase</th>
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
        </tr>
        </tbody>
    </table>
    <hr>
    <hr>
    <h3 class="text-center text-success">{{Session::get('msg')}}
        @if(Session::get('successMsg'))
            {{Session::get('successMsg')}}
        @else
            {{$secondMsg}}
        @endif
    </h3>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Total Purchase</th>
        </tr>
        </thead>
        <tbody>
        @foreach($customers as $customer)
            <tr>
                <td>{{$customerByPhone->id}}</td>
                <td>{{$customerByPhone->firstName}}</td>
                <td>{{$customerByPhone->lastName}}</td>
                <td>{{$customerByPhone->phoneNumber}}</td>
                <td>{{$customerByPhone->email}}</td>
                <td>{{$customerByPhone->address}}</td>
                <td>{{$customerByPhone->totalPurchaseBDT}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
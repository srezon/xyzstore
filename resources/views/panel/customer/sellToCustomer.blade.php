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
            <th>Total Products Bought</th>
            <th>Total Purchase (BDT)</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{$customerByPhone->id}}</td>
            <td><a href="{{ url('/customer/'.$customerByPhone->phoneNumber) }}">{{$customerByPhone->firstName}}</a></td>
            <td>{{$customerByPhone->lastName}}</td>
            <td><a href="{{ url('/customer/'.$customerByPhone->phoneNumber) }}">{{$customerByPhone->phoneNumber}}</a>
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
        </tr>
        </tbody>
    </table>
    <hr>

    <div class="container">
        <div class="col-lg-11">
            {!! Form::open( [ 'url'=>'sale/do/', 'method' =>'get', 'class' =>'form-horizontal', 'role'=>'search' ] ) !!}
            <div class="input-group add-on form-group">
                <label class="control-label">Select Product</label>
                <select class="form-control select2" id="" name="productId" required>
                    <option value></option>
                    @foreach($productsArray as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                    @endforeach
                </select>
                <input type="hidden" value="{{ $customerByPhone->phoneNumber }}" class="form-control"
                       placeholder="Enter Customer ID to find them..." name="customerPhone" id="srch-term"
                       type="number">
                <div class="input-group-btn ">
                    <button class="btn btn-default btn-sm" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
    <hr>
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: 'Select a Product',
                allowClear: true,
            });
        });
    </script>
@endsection

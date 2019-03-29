@extends('panel.master')


@section('content')

    <hr/>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center text-success">{{Session::get('msg')}}</h3>
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'customer/update', 'method' =>'POST', 'class' =>'form-horizontal', 'enctype'=>'multipart/form-data' ] ) !!}
                <input type="hidden" name="id" value="{{ $customer->id }}">
                <div class="form-group">
                    <label class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstName" value="{{$customer->firstName}}">
                        <span class="text-danger">{{ $errors->has('firstName') ? $errors->first('firstName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastName" value="{{$customer->lastName}}">
                        <span class="text-danger">{{ $errors->has('lastName') ? $errors->first('lastName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phoneNumber" value="{{$customer->phoneNumber}}">
                        <span class="text-danger">{{ $errors->has('phoneNumber') ? $errors->first('phoneNumber') : '' }}</span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{$customer->email}}">
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="address">{{$customer->address}}</textarea>
                        <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success btn-block">Update</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
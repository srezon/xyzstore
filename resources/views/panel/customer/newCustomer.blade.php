@extends('panel.master')

@section('content')
    <hr/>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center text-success">
                @if ($firstMsg)
                    {{$firstMsg}}
                @elseif ($msg)
                    {{$msg}}
                @endif
            </h3>
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'customer/save', 'method' =>'POST', 'class' =>'form-horizontal', 'enctype'=>'multipart/form-data' ] ) !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="firstName" required>
                        <span class="text-danger">{{ $errors->has('firstName') ? $errors->first('firstName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="lastName">
                        <span class="text-danger">{{ $errors->has('lastName') ? $errors->first('lastName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phoneNumber" required>
                        <span class="text-danger">{{ $errors->has('phoneNumber') ? $errors->first('phoneNumber') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email">
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="address"></textarea>
                        <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn" class="btn btn-success btn-block">Add Customer to Record
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
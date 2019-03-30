@extends('panel.master')
{{--@php dd($user); @endphp--}}
@section('content')

    <hr/>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center text-success">{{Session::get('msg')}}</h3>
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'user/update', 'method' =>'POST', 'class' =>'form-horizontal', 'enctype'=>'multipart/form-data' ] ) !!}
                <input type="hidden" name="id" value="{{ $user->id }}" required>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Application Role</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role_id" required>
                            <option>Select Role</option>
                            <option value=1 @if($user->role_id == 1 || $user->role_id == null) selected @endif>
                                Admin/Manager
                            </option>
                            <option value=2 @if($user->role_id == 2) selected @endif>User/Employee</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="name" value="{{$user->name}}" required>
                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Contact Number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="contact" value="{{$user->contact}}" required>
                        <span class="text-danger">{{ $errors->has('contact') ? $errors->first('contact') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email Address</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="email" value="{{$user->email}}" required>
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="address" required>{{$user->address}}</textarea>
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
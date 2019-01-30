@extends('panel.master')
@section('content')
    <hr/>

    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center text-success">{{ Session::get('successMsg') }}</h3>
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'/brand/save', 'method' =>'POST', 'class' =>'form-horizontal' ] ) !!}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Brand Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="brandName">
                        <span class="text-danger">{{ $errors->has('brandName') ? $errors->first('brandName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Brand Notes</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="brandNotes" rows="8"></textarea>
                        <span class="text-danger">{{ $errors->has('brandNotes') ? $errors->first('brandNotes') : '' }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn" class="btn btn-success btn-block">Create Brand</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection
@extends('panel.master')

@section('content')
    <hr/>

    <div class="row">
        <div class="col-lg-12">
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'brand/update', 'method' =>'POST', 'class' =>'form-horizontal', 'name'=>'editBrandForm' ] ) !!}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Brand Name <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $brandByID->brandName }}" class="form-control"
                               name="brandName" required>
                        <input type="hidden" value="{{ $brandByID->id }}" class="form-control" name="id">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Brand Description <span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="brandNotes"
                                  rows="8" required>{{ $brandByID->brandNotes }}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn" class="btn btn-success btn-block">Update Brand Info</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
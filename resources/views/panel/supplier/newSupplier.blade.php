@extends('panel.master')
@section('content')

    <hr/>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center text-success">
                @if(Session::get('successMsg'))
                    {{Session::get('successMsg')}}
                @else
                    {{$addMsg}}
                @endif

            </h3>
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'supplier/save', 'method' =>'POST', 'class' =>'form-horizontal', 'enctype'=>'multipart/form-data' ] ) !!}
                <div class="form-group">
                    <label class="col-sm-2 control-label">Supplier Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="supplierName" required>
                        <span class="text-danger">{{ $errors->has('supplierName') ? $errors->first('supplierName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Supplier Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="supplierPhone" required>
                        <span class="text-danger">{{ $errors->has('supplierPhone') ? $errors->first('supplierPhone') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Supplier Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="supplierEmail">
                        <span class="text-danger">{{ $errors->has('supplierEmail') ? $errors->first('supplierEmail') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Brand</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="brandID" required>
                            <option>Select Category Name</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brandName }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger">{{ $errors->has('brandID') ? $errors->first('brandID') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Supplier Address</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="supplierAddress" rows="2" required></textarea>
                        <span class="text-danger">{{ $errors->has('supplierAddress') ? $errors->first('supplierAddress') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn" class="btn btn-success btn-block">Save Supplier Info</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
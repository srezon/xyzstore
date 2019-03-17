@extends('panel.master')
@section('content')

    <hr/>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center text-success">
                @if(Session::get('successMsg'))
                    {{Session::get('successMsg')}}
                @else
                    {{$editMsg}}
                @endif

            </h3>
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'supplier/update/'.$supplier->id, 'method' =>'POST', 'class' =>'form-horizontal', 'name'=>'editProductForm'] ) !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Product Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$supplier->supplierName}}" name="supplierName">
                        <span class="text-danger">{{ $errors->has('supplierName') ? $errors->first('supplierName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Phone</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$supplier->supplierPhone}}"
                               name="supplierPhone">
                        <span class="text-danger">{{ $errors->has('supplierPhone') ? $errors->first('supplierPhone') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$supplier->supplierEmail}}"
                               name="supplierEmail">
                        <span class="text-danger">{{ $errors->has('supplierEmail') ? $errors->first('supplierEmail') : '' }}</span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-sm-2 control-label">Supplier Brand</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="brand_id" readonly>
                            <option value="{{ $brand->id }}" {{ $supplier->brand_id ==  $brand->id ? 'selected' : ''}}>{{ $brand->brandName }}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Supplier Address</label>
                    <div class="col-sm-10">
                        <textarea type="number" class="form-control"
                                  name="supplierAddress">{{$supplier->supplierAddress}}</textarea>
                        <span class="text-danger">{{ $errors->has('supplierAddress') ? $errors->first('supplierAddress') : '' }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-success btn-block">Save Supplier Info</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        document.forms['editSupplierForm'].elements['supplierBrandID'].value ={{ $supplier->brand_id }}
    </script>
@endsection
@extends('panel.master')
@section('content')
    <hr/>
    <div class="container">
        <div class="col-lg-11">
            {!! Form::open( [ 'url'=>'sale/do/', 'method' =>'get', 'class' =>'form-horizontal', 'role'=>'search' ] ) !!}
            <div class="input-group add-on form-group">
                <input class="form-control" placeholder="Enter Product ID to find it..." name="productID" id="srch-term"
                       type="number">
                <input class="form-control" placeholder="Enter Customer ID to find them..." name="customerPhone"
                       id="srch-term"
                       type="number">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
    @if(isset($productByID))
        <br>
        <h3 class="text text-success">Product Information</h3>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Model</th>
                <th>Product Category</th>
                <th>Product Brand</th>
                <th>Product Quantity</th>
                <th>Product Price</th>
                <th>Product Notes</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{$productByID->id }}</th>
                <th>{{$productByID->productName }}</th>
                <td>{{ $productByID->productModel }}</td>
                <td>{{ $actualCategory }}</td>
                <td>{{ $actualBrand }}</td>
                <td> {{ $productByID->productQuantity }}</td>
                <td>TK. {{ $productByID->productSellingPrice }}</td>
                <td> {{ $productByID->productNotes }}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <h3 class="text text-success">Customer and Invoice Information</h3>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="text-center text-success">{{ Session::get('message') }}</h3>
                <div class="well">
                    {!! Form::open( [ 'url'=>'sale/save', 'method' =>'POST', 'class' =>'form-horizontal', 'name'=>'newSale'] ) !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Invoice Code</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="invoiceCode">
                                <option>Select Invoice Code</option>
                                @foreach($invoices as $invoice)
                                    <option value="{{ $invoice->invoiceCode }}">{{ $invoice->invoiceCode }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->has('$invoice') ? $errors->first('$invoice') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Customer Name</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   value="{{ $customerByID->firstName.' '.$customerByID->lastName }}"
                                   class="form-control" name="customerName" readonly>
                            <span class="text-danger">{{ $errors->has('customerName') ? $errors->first('customerName') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Customer ID</label>
                        <div class="col-sm-10">
                            <input value="{{ $customerByID->id }}" class="form-control" name="customerID" readonly>
                            <span class="text-danger">{{ $errors->has('customerByID') ? $errors->first('customerByID') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Product ID</label>
                        <div class="col-sm-10">
                            <input value="{{ $productByID->id }}" class="form-control" name="productID" readonly>
                            <span class="text-danger">{{ $errors->has('productID') ? $errors->first('productID') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Product Full Name</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   value="{{ $productByID->productBrand." ".$productByID->productName." ".$productByID->productModel }}"
                                   class="form-control" name="productFullName" readonly>
                            <input type="hidden" value="{{ $productByID->id }}" class="form-control" name="productByID">
                            <span class="text-danger">{{ $errors->has('productFullName') ? $errors->first('productFullName') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Price per Unit</label>
                        <div class="col-sm-10">
                            <input type="number" value="{{ $productByID->productSellingPrice }}" class="form-control"
                                   name="pricePerUnit" readonly>
                            <span class="text-danger">{{ $errors->has('pricePerUnit') ? $errors->first('pricePerUnit') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" value="1" class="form-control" name="purchaseQuantity">
                            <span class="text-danger">{{ $errors->has('purchaseQuantity') ? $errors->first('purchaseQuantity') : '' }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" name="btn" class="btn btn-success btn-block">Generate Invoice</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endsection

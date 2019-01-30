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
                {!! Form::open( [ 'url'=>'product/update', 'method' =>'POST', 'class' =>'form-horizontal', 'name'=>'editProductForm'] ) !!}

                <div class="form-group">
                    <label class="col-sm-2 control-label">Product ID</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$productByID->id}}" name="productID" readonly>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Product Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$productByID->productName}}" name="productName">
                        <span class="text-danger">{{ $errors->has('productName') ? $errors->first('productName') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Product Model</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{$productByID->productModel}}" name="productModel">
                        <span class="text-danger">{{ $errors->has('productModel') ? $errors->first('productModel') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Product Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="productCategoryID">
                            <option>Select Category Name</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->categoryName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Product Brand</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="productBrandID">
                            <option>Select Brand Name</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brandName }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Product Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="{{$productByID->productQuantity}}" name="productQuantity">
                        <span class="text-danger">{{ $errors->has('productQuantity') ? $errors->first('productQuantity') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Product Buying Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="{{$productByID->productBuyingPrice}}" name="productBuyingPrice">
                        <span class="text-danger">{{ $errors->has('productBuyingPrice') ? $errors->first('productBuyingPrice') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Product Selling Price</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" value="{{$productByID->productSellingPrice}}" name="productSellingPrice">
                        <span class="text-danger">{{ $errors->has('productSellingPrice') ? $errors->first('productSellingPrice') : '' }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Product Notes</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="productNotes" value="{{$productByID->id}}" rows="5"></textarea>
                        <span class="text-danger">{{ $errors->has('productNotes') ? $errors->first('productNotes') : '' }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn" class="btn btn-success btn-block">Save Product Info</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
<script>
    document.forms['editProductForm'].elements['productCategoryID'].value={{ $productByID->productCategoryID }}
    document.forms['editProductForm'].elements['productBrandID'].value={{ $productByID->productBrandID }}
</script>
@endsection
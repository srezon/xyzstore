
@extends('panel.master')
@section('content')
    <hr>
    <div class="container">
        <div class="col-lg-11">
            {!! Form::open( [ 'url'=>'productfind/do/', 'method' =>'get', 'class' =>'form-horizontal', 'role'=>'search' ] ) !!}
            <div class="input-group add-on form-group">
                <input class="form-control" placeholder="Find Product with Product Code..." name="productCode" id="srch-term"
                       type="number">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
            {!! Form::close()!!}
        </div>
    </div>
    <hr>

    <h3 class="text-center text-success">{{Session::get('msg')}}
        @if(Session::get('successMsg'))
            {{Session::get('successMsg')}}
        @else
            {{--$firstMsg.$customerByPhone->customerPrimaryContact--}}
        @endif</h3>
    </h3>

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
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">{{$foundProduct->id }}</th>
                <th>{{$foundProduct->productName }}</th>
                <td>{{ $foundProduct->productModel }}</td>
                <td><a class="link2" href="{{ url('/category/'.$foundProduct->productCategoryID) }}">{{$foundProductCategoryName->categoryName}}</a></td>
                <td><a class="link2" href="{{ url('/brand/'.$foundProduct->productBrandID) }}">{{$foundProductBrandName->brandName}}</a></td>
                <td>{{ $foundProduct->productQuantity }}</td>
                <td>TK. {{ $foundProduct->productSellingPrice }}</td>
                <td>{{ $foundProduct->productNotes }}</td>
                <td>
                    {{--<a href="{{ url('/products/view/'.$product->id) }}" class="btn btn-info" title="Product View">--}}
                    {{--<span class="glyphicon glyphicon-info-sign"></span>--}}
                    {{--</a>--}}
                    <a href="{{ url('/product/edit/'.$foundProduct->id) }}" class="btn btn-success" title="Product Edit">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('/product/delete/'.$foundProduct->id) }}" title="Product Delete" class="btn btn-danger"
                       onclick="return confirm('Are you sure to delete this'); ">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>

        </tbody>
    </table>

    <hr>
    <hr>

    <h3 class="text-center text-success">{{Session::get('msg')}}
        @if(Session::get('successMsg'))
            {{Session::get('successMsg')}}
        @else
            {{--$secondMsg--}}
        @endif</h3>
    </h3>
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
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <th scope="row">{{$product->id }}</th>
                <th>{{$product->productName }}</th>
                <td>{{ $product->productModel }}</td>
                <td><a class="link2" href="{{ url('/category/'.$product->productCategoryID) }}">{{$product->categoryName}}</a></td>
                <td><a class="link2" href="{{ url('/brand/'.$product->productBrandID) }}">{{$product->brandName}}</a></td>
                <td>{{ $product->productQuantity }}</td>
                <td>TK. {{ $product->productSellingPrice }}</td>
                <td>{{ $product->productNotes }}</td>
                <td>
                    {{--<a href="{{ url('/products/view/'.$product->id) }}" class="btn btn-info" title="Product View">--}}
                    {{--<span class="glyphicon glyphicon-info-sign"></span>--}}
                    {{--</a>--}}
                    <a href="{{ url('/product/edit/'.$product->id) }}" class="btn btn-success" title="Product Edit">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('/product/delete/'.$product->id) }}" title="Product Delete" class="btn btn-danger"
                       onclick="return confirm('Are you sure to delete this'); ">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
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
    <h3 class="text-center text-success">
        @if(Session::get('successMsg'))
            {{Session::get('successMsg')}}
        @else
            {{$firstMsg}}
        @endif</h3>
    <hr/>

    <table id="datatable" class="table table-bordered table-hover display">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Model</th>
            <th>Product Category</th>
            <th>Product Brand</th>
            <th>Product Quantity</th>
            <th>Product Selling Price</th>
            <th>Product Notes</th>
            <th>Total Sold</th>
            <th>Expiry</th>
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
                <td>{{ $product->productTotalSold }}</td>
                <td>{{ $product->expiry or '--'}}</td>
                <td>
                    {{--<a href="{{ url('/products/view/'.$product->id) }}" class="btn btn-info" title="Product View">--}}
                    {{--<span class="glyphicon glyphicon-info-sign"></span>--}}
                    {{--</a>--}}
                    <a href="{{ url('/product/edit/'.$product->id) }}" class="btn btn-success btn-xs" title="Product Edit">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('/product/delete/'.$product->id) }}" title="Product Delete" class="btn btn-danger btn-xs"
                       onclick="return confirm('Are you sure to delete this'); ">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
    <script>
        $(function(){
            $("#datatable").dataTable(
                {
                }
            );
        })
    </script>

@endsection

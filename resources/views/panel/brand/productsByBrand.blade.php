@extends('panel.master')

@section('content')

    <hr/>
    <h3 class="text-center text-success">
        Brand: {{$productBrand->brandName}}
    </h3>
    <hr/>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Model</th>
            <th>Product Category</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Product Notes</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productsByBrand as $productByBrand)
            <tr>
                <th scope="row">{{$productByBrand->id }}</th>
                <th>{{$productByBrand->productName }}</th>
                <td>{{ $productByBrand->productModel }}</td>
                <td><a class="link2"
                       href="{{ url('/category/'.$productByBrand->productCategoryID) }}">{{$productByBrand->categoryName}}</a>
                </td>
                <td> {{ $productByBrand->productQuantity }}</td>
                <td>TK. {{ $productByBrand->productPrice }}</td>
                <td> {{ $productByBrand->productNotes }}</td>
                <td>
                    {{--<a href="{{ url('/products/view/'.$product->id) }}" class="btn btn-info" title="Product View">--}}
                    {{--<span class="glyphicon glyphicon-info-sign"></span>--}}
                    {{--</a>--}}
                    <a href="{{ url('/product/edit/'.$productByBrand->id) }}" class="btn btn-success"
                       title="Product Edit">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('/product/delete/'.$productByBrand->id) }}" title="Product Delete"
                       class="btn btn-danger"
                       onclick="return confirm('Are you sure to delete this'); ">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
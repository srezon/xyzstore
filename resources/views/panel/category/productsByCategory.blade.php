@extends('panel.master')
@section('content')
    <hr/>
    <h3 class="text-center text-success">
        Category: {{$productCategory->categoryName}}
    </h3>
    <hr/>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Product Model</th>
            <th>Product Brand</th>
            <th>Product Quantity</th>
            <th>Product Price</th>
            <th>Product Notes</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productsByCategory as $productByCategory)
            <tr>
                <th scope="row">{{$productByCategory->id }}</th>
                <th>{{$productByCategory->productName }}</th>
                <td>{{ $productByCategory->productModel }}</td>
                <td><a class="link2" href="{{ url('/brand/'.$productByCategory->productBrandID) }}">{{$productByCategory->brandName}}</a></td>
                <td> {{ $productByCategory->productQuantity }}</td>
                <td>TK. {{ $productByCategory->productPrice }}</td>
                <td> {{ $productByCategory->productNotes }}</td>
                <td>
                    {{--<a href="{{ url('/products/view/'.$product->id) }}" class="btn btn-info" title="Product View">--}}
                    {{--<span class="glyphicon glyphicon-info-sign"></span>--}}
                    {{--</a>--}}
                    <a href="{{ url('/product/edit/'.$productByCategory->id) }}" class="btn btn-success"
                       title="Product Edit">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{ url('/product/delete/'.$productByCategory->id) }}" title="Product Delete"
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
@extends('panel.master')
@section('content')

    <h3 class="text-center text-success">

        @if(Session::get('successMsg'))
            {{Session::get('successMsg')}}
        @else
            {{ Session::get('message') }}
            {{--{{$firstMsg}}--}}
        @endif


    </h3>
    <br>

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Brand</th>
            <th>Address</th>
            <th>Action</th>
        </tr>

        </thead>
        <tbody>
        @foreach($suppliers as $supplier)
            <tr>
                <th scope="row">{{$supplier->id}}</th>
                <th scope="row">{{$supplier->supplierName}}</th>
                <th scope="row">{{$supplier->supplierPhone}}</th>
                <th scope="row">{{$supplier->supplierEmail}}</th>
                <td><a class="link2"
                       href="{{ url('/brand/'.$supplier->brand->id) }}">{{$supplier->brand->brandName}}</a>
                </td>
                <th scope="row">{{$supplier->supplierAddress}}</th>

                <td>
                    <a href="{{url('/supplier/edit/'.$supplier->id)}}" class="btn btn-default">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    @if($supplier->brand == null)
                        <a href="{{url('/supplier/delete/'.$supplier->id)}}" class="btn btn-danger"
                           onclick="return confirm('Are you sure to delete it?');">
                            <span class="glyphicon glyphicon-trash"></span>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
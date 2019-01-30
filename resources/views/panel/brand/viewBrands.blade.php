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
            <th>Brand Name</th>
            <th>Brand Notes</th>
            <th>Action</th>
        </tr>

        </thead>
        <tbody>
        @foreach($brands as $brand)
            <tr>
                <th scope="row">{{$brand->id}}</th>
                <td><a class="link2"
                       href="{{ url('/brand/'.$brand->id) }}">{{$brand->brandName}}</a>
                </td>
                <td>{{$brand->brandNotes}}</td>
                <td>
                    <a href="{{url('/brand/edit/'.$brand->id)}}" class="btn btn-default">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="{{url('/brand/delete/'.$brand->id)}}" class="btn btn-danger"
                       onclick="return confirm('Are you sure to delete it?');">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
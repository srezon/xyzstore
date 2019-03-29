@extends('panel.master')
@section('content')
    <hr>
    <h3 class="text-center text-success">{{Session::get('msg')}}
        @if(Session::get('successMsg'))
            {{Session::get('successMsg')}}
        @else
            {{$firstMsg}}
        @endif</h3>
    </h3>
    <hr>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Role</th>
            <th>Name</th>
            <th>Contact Number</th>
            <th>Email</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->roleName}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->contact}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->address}}</td>
                <td>
                    <a href="{{ url('/user/edit/'.$user->phoneNumber) }}" class="btn btn-success"
                       title="Edit User">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
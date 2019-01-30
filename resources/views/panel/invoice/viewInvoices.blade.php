@extends('panel.master')

@section('content')

    <hr>

    <table class="table table-bordered table-hover">
        <thead>
        <tr style="background-color: #4DB6AC; color: white;">
            <th>Invoice ID</th>
            <th>Customer Name</th>
            <th>Total Products</th>
            <th>Total Bill</th>
            <th>Delivered</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td><a href="{{ url('/invoice/'.$invoice->invoiceCode) }}">{{$invoice->invoiceCode}}</a></td>
                <th>{{$invoice->firstName.' '.$invoice->lastName }}</th>
                <td>{{ $invoice->totalProducts }}</td>
                <td>TK. {{ $invoice->totalBill }}</td>
                <td>{{ $invoice->delivered }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>



<hr>
<hr>
<hr>





@endsection
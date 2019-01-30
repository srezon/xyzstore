@extends('panel.master')

@section('content')

    <hr>

    @if(($invoiceByCode[0]->delivered) == "Delivered")
        <div class="col-md-13 text-center">
            <p>Delivary Starus: {{$invoiceByCode[0]->delivered}}</p></div>
    @else

        <div class="col-md-13 text-center">
            <p>Delivary Starus: {{$invoiceByCode[0]->delivered}}</p></div>
        <div class="col-md-13 text-center"><p><a href="{{ url('/customer/'.$invoiceByCode[0]->phoneNumber) }}" class="btn btn-success"
              title="Sell Product to Customer">Sell More
                <span class="glyphicon glyphicon-shopping-cart"></span>
            </a></p></div>
    @endif


    <hr>
    <div id="invoice">
        <style>

            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, .15);
                font-size: 16px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }
        </style>

        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tbody>
                            <tr>
                                <td class="title">
                                    <img src="http://localhost/XYZStore/public/images/xyzstore.png"
                                         style="width:100%; max-width:180px;">
                                </td>
                                <td>
                                    Invoice #: {{$invoiceByCode[0]->invoiceCode}}
                                    <br>
                                    Created: {{$twelveHourTimeFormat}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    DCIT Ltd.<br>
                                    Floor #9, House #34, Sonargaon Janapath <br>
                                    Sector #11, Uttara <br>
                                    Dhaka 1230, Bangladesh <br>
                                    +8801711983015
                                </td>

                                <td>Customer:<br>
                                    {{$invoiceByCode[0]->firstName.' '.$invoiceByCode[0]->lastName}}<br>
                                    {{$invoiceByCode[0]->phoneNumber}} <br>
                                    {{$invoiceByCode[0]->email}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Item(s)</td>
                    <td>Price per Unit</td>
                    <td>Quantity</td>
                    <td>Sub Total</td>
                </tr>
                @foreach($invoiceByCode as $productsOfInvoice)
                    <tr>
                        <td>{{$productsOfInvoice->productName. ' '.$productsOfInvoice->productModel }}</td>
                        <td>TK. {{ $productsOfInvoice->productSellingPrice }}</td>
                        <td>{{'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$productsOfInvoice->purchaseQuantity }}</td>
                        <td>TK. {{ $productsOfInvoice->totalBill }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total: {{$fullTotalBill->fullTotalBill}}</b>

                    </td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>


                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <hr>
    <div class="col-md-13 text-center">
        <a href="#" onclick="printDiv('invoice')" class="btn btn-info btn-lg ">
            <span class="glyphicon glyphicon-print"></span> Print
        </a>
    </div>

    <script type="text/javascript">

        function printDiv(invoice) {

            var printContents = document.getElementById(invoice).innerHTML;
            w = window.open();
            w.document.write(printContents);
            w.print();
            document.location.href = "{{ url('/invoice/makeDelivered/'.$invoiceByCode[0]->invoiceCode) }}";
            w.close();
        } </script>

@endsection
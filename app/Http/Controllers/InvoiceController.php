<?php

namespace App\Http\Controllers;

use DB;

class InvoiceController extends Controller
{
    public function viewInvoices()
    {
        //removed redundant invoice codes that were auto generated during
        DB::table('invoices')
            ->where('isProductAssigned', '=', '0')
            ->delete();


        $invoices = DB::table('invoices')
            ->leftJoin('sales', 'sales.invoicesInvoiceCode', '=', 'invoices.invoiceCode')
            ->leftJoin('customers', 'customers.id', '=', 'invoices.customerID')
            ->groupBy('invoices.invoiceCode', 'invoices.customerID', 'invoices.delivered', 'customers.firstName', 'customers.lastName')
            ->select('invoices.invoiceCode', 'invoices.customerID', DB::raw('(CASE WHEN invoices.delivered = 1 THEN "YES" ELSE "NO" END) AS delivered'), 'customers.firstName', 'customers.lastName', DB::raw('IFNULL(SUM(sales.purchaseQuantity), 0) as totalProducts'), DB::raw('IFNULL(SUM(sales.totalBill), 0) as totalBill'))
            ->get();

        //$invoices = DB::select('select * from invoices');


        return view('panel.invoice.viewInvoices')
            ->with('invoices', $invoices);
    }

    public function viewInvoiceDetails($id)
    {
        $invoiceByCode = DB::table('invoices')
            ->leftJoin('sales', 'sales.InvoicesinvoiceCode', '=', 'invoices.invoiceCode')
            ->leftJoin('customers', 'customers.id', 'invoices.customerID')
            ->leftJoin('products', 'products.id', 'sales.productID')
            ->where('invoices.invoiceCode', $id)
            ->select('invoices.invoiceCode', 'invoices.updated_at', 'customers.email', 'customers.firstName', 'customers.phoneNumber', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice',DB::raw('(CASE WHEN invoices.delivered = 1 THEN "Delivered" ELSE "Not Delivered (Print to Deliver or Sell More)" END) AS delivered'), DB::raw('SUM(sales.totalBill) as totalBill'))
            ->groupBy('invoices.invoiceCode', 'invoices.updated_at', 'customers.firstName', 'customers.email', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'customers.phoneNumber', 'invoices.delivered')
            ->get();

        $fullTotalBill = DB::table('invoices')
            ->leftJoin('sales', 'sales.InvoicesinvoiceCode', '=', 'invoices.invoiceCode')
            ->where('invoices.invoiceCode', $id)
            ->select(DB::raw('SUM(sales.totalBill) as fullTotalBill'))
            ->first();

            $twelveHourTimeFormat = date('m-d-Y h:i:s a', strtotime($invoiceByCode[0]->updated_at));

        return view('panel.invoice.invoiceDetails')
            ->with('invoiceByCode', $invoiceByCode)
            ->with('twelveHourTimeFormat', $twelveHourTimeFormat)
            ->with('fullTotalBill', $fullTotalBill);
    }

    public function makeInvoiceDelivered($id){

        DB::table('invoices')
            ->where('invoiceCode', $id)
            ->update(['delivered' => 1]);

        $invoiceByCode = DB::table('invoices')
            ->leftJoin('sales', 'sales.InvoicesinvoiceCode', '=', 'invoices.invoiceCode')
            ->leftJoin('customers', 'customers.id', 'invoices.customerID')
            ->leftJoin('products', 'products.id', 'sales.productID')
            ->where('invoices.invoiceCode', $id)
            ->select('invoices.invoiceCode', 'invoices.updated_at', 'customers.email', 'customers.firstName', 'customers.phoneNumber', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', DB::raw('(CASE WHEN invoices.delivered = 1 THEN "Delivered" ELSE "Not Delivered (Print to Deliver)" END) AS delivered'), DB::raw('SUM(sales.totalBill) as totalBill'))
            ->groupBy('invoices.invoiceCode', 'invoices.updated_at', 'customers.firstName', 'customers.email', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'customers.phoneNumber', 'invoices.delivered')
            ->get();

        $fullTotalBill = DB::table('invoices')
            ->leftJoin('sales', 'sales.InvoicesinvoiceCode', '=', 'invoices.invoiceCode')
            ->where('invoices.invoiceCode', $id)
            ->select(DB::raw('SUM(sales.totalBill) as fullTotalBill'))
            ->first();

        $twelveHourTimeFormat = date('m-d-Y h:i:s a', strtotime($invoiceByCode[0]->updated_at));

        return redirect('/invoice/'.$invoiceByCode[0]->invoiceCode)
            ->with('invoiceByCode', $invoiceByCode)
            ->with('twelveHourTimeFormat', $twelveHourTimeFormat)
            ->with('fullTotalBill', $fullTotalBill);
    }
}

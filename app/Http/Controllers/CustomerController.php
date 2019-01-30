<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Sale;
use App\Product;
use DB;

class CustomerController extends Controller
{
    public function viewCustomers()
    {
        //$customers = Customer::all();

        $customers = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select( 'customers.id', 'customers.firstName', 'customers.lastName', 'customers.phoneNumber', 'customers.email', 'customers.address', DB::raw('IFNULL(SUM(sales.purchaseQuantity), 0) as totalProductsBought'), DB::raw('IFNULL(SUM(sales.totalBill), 0) as totalPurchasedBDT'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName', 'customers.phoneNumber', 'customers.email', 'customers.address')
            ->get();


        return view('panel.customer.viewCustomers')
            ->with('customers', $customers)
            ->with('firstMsg', 'Recorded Customers:');
    }

    public function findCustomer(Request $request)
    {
//retrive specific customer of received phone number
        $customerPhone = $request->customerPhone;
        $customerByPhone = Customer::where('phoneNumber', $customerPhone)->first();
        $customers = Customer::all();
        return view('panel.customer.foundCustomer')
            ->with('customerByPhone', $customerByPhone)
            ->with('customers', $customers)
            ->with('firstMsg', 'Matched Customer for: ')
            ->with('secondMsg', 'Recorded Customers:');
        //retrive specific product of received ID
        //$productID = $request->productID;
        //$productByID = Product::find($productID);

        //retrive category name from category ID
        //$categoryID = $productByID->productCategoryID;
        //$productCategory = Category::find($categoryID);
        //$actualCategory = $productCategory->categoryName;

        //retrive customer
        //$customerID = $request->customerID;
        //$customerByID = Customer::find($customerID);

        //return view('panel.sale.newSale')->with(['productByID' => $productByID])->with(['actualCategory' => $actualCategory])->with(['customerByID' => $customerByID]);

    }

    public function newCustomer()
    {
        return view('panel.customer.newCustomer')->with('firstMsg', 'Add new Customer:');
    }

    public function saveCustomer(Request $request)
    {
        $customer = new Customer();
        $customer->firstName = $request->firstName;
        $customer->lastName = $request->lastName;
        $customer->phoneNumber = $request->phoneNumber;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->save();
        return redirect('/customers/')->with('successMsg', 'New Customer Added to Records!');
    }

    public function sellToCustomer($id)
    {
        $customerByPhone = Customer::where('phoneNumber', $id)->first();
        return view('panel.customer.sellToCustomer')
            ->with('customerByPhone', $customerByPhone);
    }
}

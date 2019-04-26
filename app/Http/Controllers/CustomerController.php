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
            ->select('customers.id', 'customers.firstName', 'customers.lastName', 'customers.phoneNumber', 'customers.email', 'customers.address', DB::raw('IFNULL(SUM(sales.purchaseQuantity), 0) as totalProductsBought'), DB::raw('IFNULL(SUM(sales.totalBill), 0) as totalPurchasedBDT'))
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
        $customers = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', 'customers.phoneNumber', 'customers.email', 'customers.address', DB::raw('IFNULL(SUM(sales.purchaseQuantity), 0) as totalProductsBought'), DB::raw('IFNULL(SUM(sales.totalBill), 0) as totalPurchasedBDT'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName', 'customers.phoneNumber', 'customers.email', 'customers.address')
            ->get();
        return view('panel.customer.foundCustomer')
            ->with('customerByPhone', $customerByPhone)
            ->with('customers', $customers)
            ->with('firstMsg', 'Matched Customer for: ')
            ->with('secondMsg', 'Recorded Customers:');
    }

    public function newCustomer()
    {
        return view('panel.customer.newCustomer')
            ->with('firstMsg', 'Add new Customer');
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
         $customerByPhone = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', 'customers.phoneNumber', 'customers.email', 'customers.address', DB::raw('IFNULL(SUM(sales.purchaseQuantity), 0) as totalProductsBought'), DB::raw('IFNULL(SUM(sales.totalBill), 0) as totalPurchasedBDT'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName', 'customers.phoneNumber', 'customers.email', 'customers.address')
            ->where('phoneNumber', $id)->first();

        $products = Product::all();
        $productsArray = [];
        foreach ($products as $product) {
            $productsArray[$product->id] = $product->id . ' - ' . $product->productName . ' - TK' . $product->productSellingPrice . ' - Quantity: ' . $product->productQuantity;
        }
//        return $productsArray;
        return view('panel.customer.sellToCustomer')
            ->with('customerByPhone', $customerByPhone)
            ->with('productsArray', $productsArray);
    }

    public function editCustomer($id)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $phoneNumber = $id;
        $customer = Customer::where('phoneNumber', $phoneNumber)->first();
        return view('panel.customer.editCustomer')->with('customer', $customer);
//        return $customer;
    }

    public function update(Request $request)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $customer = new Customer();
        $customer->find($request->id)->fill($request->all())->save();
        return redirect()->back()->with('msg', 'Customer record updated successfully.');
    }
}

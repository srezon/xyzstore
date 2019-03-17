<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Product;
use App\Sale;
use App\Brand;
use App\Supplier;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PanelController extends Controller
{
    public function index(){
        if (Auth::guest()) {
            return view('panel.authentication.login');
        } else {
            $categoryCount = Category::count();
            $productCount = Product::count();
            $saleCount = Sale::count();
            $brandCount = Brand::count();
            $customerCount = Customer::count();
            $supplierCount = Supplier::count();
            //passing data with array method
//            return view('panel.home.home', ['categoryCount'=>$categoryCount]);
            //passing data with with method
            return view('panel.home.home')
                ->with('categoryCount', $categoryCount)
                ->with('productCount', $productCount)
                ->with('saleCount', $saleCount)
                ->with('brandCount', $brandCount)
                ->with('customerCount', $customerCount)
                ->with('supplierCount', $supplierCount)
                ;
        }

//        Sir handled it with middleware https://www.youtube.com/watch?v=0bHy8O9GpFY&t=5939s (16:0)


    }
}

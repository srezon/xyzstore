<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Customer;
use App\Product;
use App\Sale;
use App\Brand;
use App\Providers;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guest()) {
            return view('panel.authentication.login');
        } else {
            $categoryCount = Category::count();
            $productCount = Product::count();
            $saleCount = Sale::count();
            $brandCount = Brand::count();
            $customerCount = Customer::count();
            //passing data with array method
//            return view('panel.home.home', ['categoryCount'=>$categoryCount]);
            //passing data with with method
            return view('panel.home.home')
                ->with('categoryCount', $categoryCount)
                ->with('productCount', $productCount)
                ->with('saleCount', $saleCount)
                ->with('brandCount', $brandCount)
                ->with('customerCount', $customerCount);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Product;
use App\Sale;
use App\Brand;
use App\Supplier;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr as Arr;


class PanelController extends Controller
{
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
            $supplierCount = Supplier::count();
            //passing data with array method
//            return view('panel.home.home', ['categoryCount'=>$categoryCount]);
            //passing data with with method

            $weeklyBuying = array_flatten($this->getWeeklyBuying());
//            $weeklySelling = $this->getWeeklySelling()->toArray();
//            return array_flatten($weeklyBuying->toArray());
//            $weeklySellingArray = Arr::flatten($weeklySelling->toArray());
//            return $weeklyBuying;

            return view('panel.home.home')
                ->with('categoryCount', $categoryCount)
                ->with('productCount', $productCount)
                ->with('saleCount', $saleCount)
                ->with('brandCount', $brandCount)
                ->with('customerCount', $customerCount)
                ->with('supplierCount', $supplierCount)
                ->with('weeklyBuying', $weeklyBuying);
        }

//        Sir handled it with middleware https://www.youtube.com/watch?v=0bHy8O9GpFY&t=5939s (16:0)
    }



    private function getWeeklyBuying()
    {
        $products = new Product();
        return $products
            ->select('productBuyingPrice as total')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            //where between = date start to date end
            ->orderBy('created_at', 'ASC')
            ->get()->toArray();

        //where between = date start to date end

    }

    private function getWeeklySelling()
    {
        $sales = new Sale();
        return $sales
            ->select('totalBill as total')
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();
    }

}

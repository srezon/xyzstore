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
use App\Charts\PanelChart;


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

            $chart = new PanelChart;
            $chart->labels($this->getLastSevenDays());
            $chart->dataset('Buying', 'line', [1, 2, 3, 4,2,3,4,4]);
            $chart->dataset('Selling', 'line', [2,3,5,4, 3, 2, 1]);


            return view('panel.home.home', compact(
                'categoryCount' ,
                'productCount' ,
                'saleCount' ,
                'brandCount' ,
                'customerCount' ,
                'supplierCount' ,
                'chart'
            ));

        }

//        Sir handled it with middleware https://www.youtube.com/watch?v=0bHy8O9GpFY&t=5939s (16:0)
    }

    /**
     * Get the last seven days
     * only the name of the days
     * @return array
     */
    private function getLastSevenDays() {
        $days = [];
        for ($i=1; $i<8; $i++) {
            $days[$i] = Carbon::now()->subDays($i)->format('D');
        }
        return array_flatten($days);
    }

}

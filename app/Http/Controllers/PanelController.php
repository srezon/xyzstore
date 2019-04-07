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
    protected $product;

    public function __construct(Product $product, Sale $sale)
    {
        $this->product = $product;
        $this->sale = $sale;
    }

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
            $chart->dataset('Buying', 'line', $this->getBuyingOfLastSevenDays())->backgroundcolor('rgba(5, 127, 37, 0.5)');
            $chart->dataset('Selling', 'line', $this->getSellingOfLastSevenDays())->backgroundcolor('rgba(186, 9, 9, 0.5)');

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
    }

    /**
     * Get the last seven days
     * only the name of the days
     * @return array
     */
    private function getLastSevenDays() {
        $days = [];
        for ($i=0; $i<7; $i++) {
            $days[$i] = Carbon::now()->subDays($i)->format('D');
        }
        return array_flatten($days);
    }

    /**
     * Data of last 7 days
     * @return array
     */
    private function getBuyingOfLastSevenDays ()
    {
        $prices = $this->product->select('productBuyingPrice as total')
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()->subDays(0)])
            ->orderBy('created_at', 'ASC')
            ->get();
        return array_flatten($prices->toArray());
    }

    /**
     * Data of last 7 days
     * @return array
     */
    private function getSellingOfLastSevenDays ()
    {
        $prices = $this->sale->select('totalBill as total')
            ->whereBetween('created_at', [Carbon::now()->subDays(6), Carbon::now()->subDays(0)])
            ->orderBy('created_at', 'ASC')
            ->get();
        return array_flatten($prices->toArray());
    }


}

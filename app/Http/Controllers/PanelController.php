<?php

namespace App\Http\Controllers;

use App\Category;
use App\Customer;
use App\Product;
use App\Sale;
use App\Brand;
use App\Supplier;

use Carbon\Carbon;
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

//        return 'sss';
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
            $chart->dataset('Buying', 'line', $this->getTransactionData($this->product, 'productBuyingPrice','productQuantity', 7))
                ->backgroundcolor('rgba(5, 127, 37, 0.5)');
            $chart->dataset('Selling', 'line', $this->getTransactionData($this->sale, 'totalBill',
                'purchaseQuantity', 7))->backgroundcolor
            ('rgba(186, 9, 9, 0.5)');

            return view('panel.home.home', compact(
                'categoryCount',
                'productCount',
                'saleCount',
                'brandCount',
                'customerCount',
                'supplierCount',
                'chart'
            ));

        }
    }

    /**
     * Get the last seven days
     * only the name of the days
     * @return array
     */
    private function getLastSevenDays()
    {
        $days = [];
        for ($i = 0; $i < 7; $i++) {
            $days[$i] = Carbon::now()->subDays($i)->format('l (d - F)');
        }
        return array_flatten($days);
    }

    /**
     * This method will go through the bookings records
     * sum off the each days amount to total
     * if no transaction it will take 0 as replacement of null
     *
     * @param $days
     * @return array
     */
    private function getTransactionData($model, $price, $quantity, $days)
    {
        //vars
        $transactions = [];
        //Loop
        for ($i = 0; $i < $days; $i++) {
            $transactions[] = $model->whereBetween('created_at', [
                Carbon::now()->subDays($i)->startOfDay()->toDateTimeString(),
                Carbon::now()->subDays($i)->endOfDay()->toDateTimeString()
            ])
                ->selectRaw('COALESCE(SUM(' . $price . ' * ' . $quantity . '), 0) as total')
                ->get()
                ->toArray();
        }
        //returns
        return array_flatten($transactions);
    }

}

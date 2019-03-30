<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Customer;
use App\Invoice;
use App\Product;
use App\Sale;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;


class SaleController extends Controller
{
    const SATURDAY = 0;
    const SUNDAY = 1;
    const MONDAY = 2;
    const TUESDAY = 3;
    const WEDNESDAY = 4;
    const THURSDAY = 5;
    const FRIDAY = 6;

    protected static $weekStartsAt = self::SATURDAY;
    protected static $weekEndsAt = self::FRIDAY;
    public function newSale()
    {

        return view('panel.sale.newSale');
    }

    public function doSale(Request $request)
    {
//        return $request->all();
        //return $
        //return request->id;
        //retrieve specific product of received ID
        $productId = $request->productId;
         $productByID = Product::find($productId);
        //retrieve category name from category ID
        if (!empty($productByID)) {
            $categoryID = $productByID->productCategoryID;
            $productCategory = Category::find($categoryID);
            $actualCategory = $productCategory->categoryName;
        }
        //retrieve brand name from brand ID
        if (!empty($productByID)) {
            $brandID = $productByID->productBrandID;
            $productBrand = Brand::find($brandID);
            $actualBrand = $productBrand->brandName;
        }

        //retrieve customer
        $customerPhone = $request->customerPhone;
        $customerByID = Customer::Where('phoneNumber', $customerPhone)->first();


        //removed redundant invoice codes that were auto generated during
        // newSale page load and doesn't have any product associate
        DB::table('invoices')
            ->where('isProductAssigned', '=', '0')
            ->delete();


        //Pre-generate  and store invoice code from current date and time
        $currentDateTime = Carbon::now()->toDateTimeString();
        $invoiceCode = str_replace(["-", "–", "/", " ", ':'], '', $currentDateTime);


        //Store the temporary generated invoice code
        $invoice = new Invoice();
        $invoice->invoiceCode = $invoiceCode;
        $invoice->customerID = $customerByID->id;
        $invoice->delivered = 0;
        $invoice->isProductAssigned = 0;
        $invoice->save();


        $invoices = DB::table('invoices')
            ->where('delivered', '=', '0')
            ->get();

        foreach ($invoices as $invoice) {
            if ($invoice->isProductAssigned == 0) {
                $invoice->invoiceCodeDetails = $invoice->invoiceCode . ' (New Invoice)';
            } else {
                $theCustomer = Customer::find($invoice->customerID);
                $invoice->invoiceCodeDetails = $invoice->invoiceCode . ' (Undelivered/Pending Invoice - ' . $theCustomer->firstName . ' - ' . $theCustomer->phoneNumber . ')';
            }
        }

        if (isset($actualCategory) && !empty($customerByID)) {
            return view('panel.sale.newSale')
                ->with(['productByID' => $productByID])
                ->with(['actualCategory' => $actualCategory])
                ->with(['actualBrand' => $actualBrand])
                ->with(['customerByID' => $customerByID])
                ->with(['invoices' => $invoices]);
        } else {
            return view('panel.sale.newSale');
        }
    }

    public function saveSale(Request $request)
    {
        //validation
        $this->validate($request, [
            'customerName' => 'required',
            'customerID' => 'required',
            'productID' => 'required',
            'productByID' => 'required',
            'pricePerUnit' => 'required|integer|min:1',
            'purchaseQuantity' => 'required|integer|min:1',
            'invoiceCode' => 'required',
        ]);

        $thisProduct = Product::find($request->productID);
        if ($thisProduct->productQuantity <= 0) {
            return redirect()->back()->withInput($request->all())->with('stockOut', 'This Product is out of stock');
        }


        $isOldInvoice = DB::table('invoices')
            ->select('invoiceCode')
            ->where('invoiceCode', '=', $request->invoiceCode)
            ->where('isProductAssigned', '=', 0)
            ->get();


        if ($isOldInvoice == []) {
            //new invoice
            $invoice = new Invoice();
            $invoice->invoiceCode = $request->invoiceCode;
            $invoice->customerID = $request->customerID;
            $invoice->isProductAssigned = 1;
            $invoice->delivered = 0;
            $invoice->save();

            //saving to sales table
            $sale = new Sale();
            $sale->customerID = $request->customerID;
            $sale->productID = $request->productID;
            $sale->invoicesInvoiceCode = $request->invoiceCode;//$request->invoiceCode
            $sale->purchaseQuantity = $request->purchaseQuantity;
            $sale->totalBill = ($request->pricePerUnit) * ($request->purchaseQuantity);
            $sale->save();

            //update product quantity
            $oldProductQuantity = DB::table('products')
                ->select('productQuantity')
                ->where('id', '=', $request->productID)
                ->get();

            $newProductQuantity = $oldProductQuantity[0]->productQuantity - $request->purchaseQuantity;

            DB::table('products')
                ->where('id', $request->productID)
                ->update(['productQuantity' => $newProductQuantity]);

        } else {
            //old invoice

            DB::table('invoices')
                ->where('invoiceCode', $request->invoiceCode)
                ->update(['isProductAssigned' => 1]);

            //saving to sales table
            $sale = new Sale();
            $sale->customerID = $request->customerID;
            $sale->productID = $request->productID;
            $sale->invoicesInvoiceCode = $request->invoiceCode;//$request->invoiceCode
            $sale->purchaseQuantity = $request->purchaseQuantity;
            $sale->totalBill = ($request->pricePerUnit) * ($request->purchaseQuantity);
            $sale->save();

            //update product quantity
            $oldProductQuantity = DB::table('products')
                ->select('productQuantity')
                ->where('id', '=', $request->productID)
                ->get();

            $newProductQuantity = $oldProductQuantity[0]->productQuantity - $request->purchaseQuantity;

            DB::table('products')
                ->where('id', '=', $request->productID)
                ->update(['productQuantity' => $newProductQuantity]);

            //return redirect('/sales/')->with('successMessage', 'Invoice and Product updated!');
            return redirect('/invoice/' . $request->invoiceCode)->with('successMessage', 'Invoice and Product updated!');
        }


    }

    public function viewSales()
    {
        //get records of all sales
        //$sales = Sale::all();
        $sales = DB::table('sales')
            ->leftJoin('customers', 'sales.customerID', '=', 'customers.id')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select('sales.id', 'customers.firstName', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'sales.totalBill')
            ->get();

        $totalCustomers = DB::table('customers')
            ->count();

        $totalProductsSold = DB::table('sales')
            ->select(DB::raw('SUM(purchaseQuantity) as totalSold'))
            ->get();

        $totalCost = DB::table('sales')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select(DB::raw('SUM(products.productBuyingPrice * sales.purchaseQuantity) as totalCost'))
            ->get();

        $totalSaleCost = DB::table('sales')
            ->select(DB::raw('SUM(totalBill) as totalBill'))
            ->get();

        //with get(), we get Collection and with first() or find(), we get object
        //accessing Collection and accessing Object is little bit different
        //https://stackoverflow.com/questions/41366092/laravel-property-title-does-not-exist-on-this-collection-instance
        //finding the profit
        $totalProfit = $totalSaleCost[0]->totalBill - $totalCost[0]->totalCost;

        //finding profit percentage
        if ($totalCost[0]->totalCost == 0) {
            $profitPercentage = 0;
        } else {
            $profitPercentage = round(($totalProfit * 100) / $totalCost[0]->totalCost);

        }
//        $profitPercentage = round(($totalProfit / $totalCost[0]->totalCost ) * 100);

        $topCustomersByExpense = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.totalBill) as totalExpense'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalExpense', 'desc')
            //->limit('1')
            ->get();

        $topCustomersByProductQt = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.purchaseQuantity) as totalQuantity'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalQuantity', 'desc')
            //->limit('1')
            ->get();

        $topSellingProducts = DB::table('products')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'categories.categoryName as categoryNamee', 'products.productCategoryID', DB::raw('SUM(sales.purchaseQuantity) as sellingQuantity'))
            ->groupBy('products.id', 'products.productName', 'products.productCategoryID', 'categories.categoryName')
            ->orderBy('sellingQuantity', 'desc')
            //->limit('1')
            ->get();

        return view('panel.sale.viewSales')
            ->with('sales', $sales)
            ->with('totalCustomers', $totalCustomers)
            ->with('totalProductsSold', $totalProductsSold)
            ->with('totalCost', $totalCost)
            ->with('totalSaleCost', $totalSaleCost)
            ->with('totalProfit', $totalProfit)
            ->with('profitPercentage', $profitPercentage)
            ->with('topCustomersByExpense', $topCustomersByExpense)
            ->with('topCustomersByProductQt', $topCustomersByProductQt)
            ->with('topSellingProducts', $topSellingProducts);
    }

    public function viewThisMonthSales()
    {
        //get records of all sales
        //$sales = Sale::all();
        $sales = DB::table('sales')
            ->leftJoin('customers', 'sales.customerID', '=', 'customers.id')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select('sales.id', 'customers.firstName', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'sales.totalBill')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            ->get();

        $totalCustomers = DB::table('customers')
            ->leftJoin('sales', 'sales.customerID', '=', 'customers.id')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            ->count();

        $totalProductsSold = DB::table('sales')
            ->select(DB::raw('SUM(purchaseQuantity) as totalSold'))
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            ->get();

        $totalCost = DB::table('sales')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select(DB::raw('SUM(products.productBuyingPrice * sales.purchaseQuantity) as totalCost'))
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            ->get();

        $totalSaleCost = DB::table('sales')
            ->select(DB::raw('SUM(totalBill) as totalBill'))
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            ->get();

        //with get(), we get Collection and with first() or find(), we get object
        //accessing Collection and accessing Object is little bit different
        //https://stackoverflow.com/questions/41366092/laravel-property-title-does-not-exist-on-this-collection-instance
        //finding the profit
        $totalProfit = $totalSaleCost[0]->totalBill - $totalCost[0]->totalCost;

        //finding profit percentage
        if ($totalCost[0]->totalCost != 0) {
            $profitPercentage = round(($totalProfit * 100) / $totalCost[0]->totalCost);
        } else {
            $profitPercentage = 0;
        }  //        $profitPercentage = round(($totalProfit / $totalCost[0]->totalCost ) * 100);

        $topCustomersByExpense = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.totalBill) as totalExpense'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalExpense', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            //->limit('1')
            ->get();

        $topCustomersByProductQt = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.purchaseQuantity) as totalQuantity'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            //->limit('1')
            ->get();

        $topSellingProducts = DB::table('products')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'categories.categoryName as categoryNamee', 'products.productCategoryID', DB::raw('SUM(sales.purchaseQuantity) as sellingQuantity'))
            ->groupBy('products.id', 'products.productName', 'products.productCategoryID', 'categories.categoryName')
            ->orderBy('sellingQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfMonth())
            //->limit('1')
            ->get();

        return view('panel.sale.viewThisMonthSales')
            ->with('sales', $sales)
            ->with('totalCustomers', $totalCustomers)
            ->with('totalProductsSold', $totalProductsSold)
            ->with('totalCost', $totalCost)
            ->with('totalSaleCost', $totalSaleCost)
            ->with('totalProfit', $totalProfit)
            ->with('profitPercentage', $profitPercentage)
            ->with('topCustomersByExpense', $topCustomersByExpense)
            ->with('topCustomersByProductQt', $topCustomersByProductQt)
            ->with('topSellingProducts', $topSellingProducts);
    }

    public function viewLastMonthSales()
    {
        $firstDayofPreviousMonth = Carbon::now()->subMonth()->startOfMonth()->toDateString();
        $lastDayofPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->toDateString();
        //get records of all sales
        //$sales = Sale::all();

        $sales = DB::table('sales')
            ->leftJoin('customers', 'sales.customerID', '=', 'customers.id')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select('sales.id', 'customers.firstName', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'sales.totalBill')
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get();


        $totalCustomers = DB::table('customers')
            ->leftJoin('sales', 'sales.customerID', '=', 'customers.id')
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->count();

        $totalProductsSold = DB::table('sales')
            ->select(DB::raw('SUM(purchaseQuantity) as totalSold'))
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get();

        $totalCost = DB::table('sales')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select(DB::raw('SUM(products.productBuyingPrice * sales.purchaseQuantity) as totalCost'))
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get();

        $totalSaleCost = DB::table('sales')
            ->select(DB::raw('SUM(totalBill) as totalBill'))
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get();

        //with get(), we get Collection and with first() or find(), we get object
        //accessing Collection and accessing Object is little bit different
        //https://stackoverflow.com/questions/41366092/laravel-property-title-does-not-exist-on-this-collection-instance
        //finding the profit
        $totalProfit = $totalSaleCost[0]->totalBill - $totalCost[0]->totalCost;

        //finding profit percentage
        if ($totalCost[0]->totalCost != 0) {
            $profitPercentage = round(($totalProfit * 100) / $totalCost[0]->totalCost);
        } else {
            $profitPercentage = 0;
        }  //        $profitPercentage = round(($totalProfit / $totalCost[0]->totalCost ) * 100);

        $topCustomersByExpense = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.totalBill) as totalExpense'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalExpense', 'desc')
            //->limit('1')
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get();

        $topCustomersByProductQt = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.purchaseQuantity) as totalQuantity'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalQuantity', 'desc')
            //->limit('1')
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            ->get();

        $topSellingProducts = DB::table('products')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'categories.categoryName as categoryNamee', 'products.productCategoryID', DB::raw('SUM(sales.purchaseQuantity) as sellingQuantity'))
            ->groupBy('products.id', 'products.productName', 'products.productCategoryID', 'categories.categoryName')
            ->orderBy('sellingQuantity', 'desc')
            ->whereBetween('sales.created_at', [$firstDayofPreviousMonth, $lastDayofPreviousMonth])
            //->limit('1')
            ->get();

        return view('panel.sale.viewLastMonthSales')
            ->with('sales', $sales)
            ->with('totalCustomers', $totalCustomers)
            ->with('totalProductsSold', $totalProductsSold)
            ->with('totalCost', $totalCost)
            ->with('totalSaleCost', $totalSaleCost)
            ->with('totalProfit', $totalProfit)
            ->with('profitPercentage', $profitPercentage)
            ->with('topCustomersByExpense', $topCustomersByExpense)
            ->with('topCustomersByProductQt', $topCustomersByProductQt)
            ->with('topSellingProducts', $topSellingProducts);
    }

    public function viewThisWeekSales()
    {
        //Using Carbon
        //https://stackoverflow.com/questions/8541466/getting-first-last-date-of-the-week
        //Setting Week Start Date
        //Carbon::setWeekStartsAt(Carbon::SATURDAY);
        //I have used Time Zone parameter in NOW() Method, so I don't have to use it

        //get records of all sales
        //$sales = Sale::all();
        $sales = DB::table('sales')->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            ->get();

        $totalCustomers = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            ->count();

        $totalProductsSold = DB::table('sales')
            ->select(DB::raw('SUM(purchaseQuantity) as totalSold'))
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            ->get();

        $totalCost = DB::table('sales')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select(DB::raw('SUM(products.productBuyingPrice * sales.purchaseQuantity) as totalCost'))
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            ->get();

        $totalSaleCost = DB::table('sales')
            ->select(DB::raw('SUM(totalBill) as totalBill'))
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            ->get();

        //with get(), we get Collection and with first() or find(), we get object
        //accessing Collection and accessing Object is little bit different
        //https://stackoverflow.com/questions/41366092/laravel-property-title-does-not-exist-on-this-collection-instance
        //finding the profit
        $totalProfit = $totalSaleCost[0]->totalBill - $totalCost[0]->totalCost;

        //finding profit percentage
        if ($totalCost[0]->totalCost != 0) {
            $profitPercentage = round(($totalProfit * 100) / $totalCost[0]->totalCost);
        } else {
            $profitPercentage = 0;
        }
//        $profitPercentage = round(($totalProfit / $totalCost[0]->totalCost ) * 100);

        $topCustomersByExpense = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.totalBill) as totalExpense'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalExpense', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            //->limit('1')
            ->get();

        $topCustomersByProductQt = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.purchaseQuantity) as totalQuantity'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            //->limit('1')
            ->get();

        $topSellingProducts = DB::table('products')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'categories.categoryName as categoryNamee', 'products.productCategoryID', DB::raw('SUM(sales.purchaseQuantity) as sellingQuantity'))
            ->groupBy('products.id', 'products.productName', 'products.productCategoryID', 'categories.categoryName')
            ->orderBy('sellingQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::now('Asia/Dhaka')->startOfWeek())
            //->limit('1')
            ->get();

        return view('panel.sale.viewThisWeekSales')
            ->with('sales', $sales)
            ->with('totalCustomers', $totalCustomers)
            ->with('totalProductsSold', $totalProductsSold)
            ->with('totalCost', $totalCost)
            ->with('totalSaleCost', $totalSaleCost)
            ->with('totalProfit', $totalProfit)
            ->with('profitPercentage', $profitPercentage)
            ->with('topCustomersByExpense', $topCustomersByExpense)
            ->with('topCustomersByProductQt', $topCustomersByProductQt)
            ->with('topSellingProducts', $topSellingProducts);
    }

    public function viewLastWeekSales()
    {
        $firstDayofPreviousWeek = Carbon::now()->subWeek()->startOfWeek()->toDateString();
        $lastDayofPreviousWeek = Carbon::now()->subWeek()->endOfWeek()->toDateString();

        //get records of all sales
        //$sales = Sale::all();
        $sales = DB::table('sales')
            ->leftJoin('customers', 'sales.customerID', '=', 'customers.id')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select('sales.id', 'customers.firstName', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'sales.totalBill')
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            ->get();

        $totalCustomers = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            ->count();

        $totalProductsSold = DB::table('sales')
            ->select(DB::raw('SUM(purchaseQuantity) as totalSold'))
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            ->get();

        $totalCost = DB::table('sales')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select(DB::raw('SUM(products.productBuyingPrice * sales.purchaseQuantity) as totalCost'))
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            ->get();

        $totalSaleCost = DB::table('sales')
            ->select(DB::raw('SUM(totalBill) as totalBill'))
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            ->get();

        //with get(), we get Collection and with first() or find(), we get object
        //accessing Collection and accessing Object is little bit different
        //https://stackoverflow.com/questions/41366092/laravel-property-title-does-not-exist-on-this-collection-instance
        //finding the profit
        $totalProfit = $totalSaleCost[0]->totalBill - $totalCost[0]->totalCost;

        //finding profit percentage

        if ($totalCost[0]->totalCost != 0) {
            $profitPercentage = round(($totalProfit * 100) / $totalCost[0]->totalCost);
        } else {
            $profitPercentage = 0;
        }
//        $profitPercentage = round(($totalProfit / $totalCost[0]->totalCost ) * 100);

        $topCustomersByExpense = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.totalBill) as totalExpense'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalExpense', 'desc')
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            //->limit('1')
            ->get();

        $topCustomersByProductQt = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.purchaseQuantity) as totalQuantity'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalQuantity', 'desc')
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            //->limit('1')
            ->get();

        $topSellingProducts = DB::table('products')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'categories.categoryName as categoryNamee', 'products.productCategoryID', DB::raw('SUM(sales.purchaseQuantity) as sellingQuantity'))
            ->groupBy('products.id', 'products.productName', 'products.productCategoryID', 'categories.categoryName')
            ->orderBy('sellingQuantity', 'desc')
            ->whereBetween('sales.created_at', [$firstDayofPreviousWeek, $lastDayofPreviousWeek])
            //->limit('1')
            ->get();

        return view('panel.sale.viewLastWeekSales')
            ->with('sales', $sales)
            ->with('totalCustomers', $totalCustomers)
            ->with('totalProductsSold', $totalProductsSold)
            ->with('totalCost', $totalCost)
            ->with('totalSaleCost', $totalSaleCost)
            ->with('totalProfit', $totalProfit)
            ->with('profitPercentage', $profitPercentage)
            ->with('topCustomersByExpense', $topCustomersByExpense)
            ->with('topCustomersByProductQt', $topCustomersByProductQt)
            ->with('topSellingProducts', $topSellingProducts);
    }

    public function viewTodaySales()
    {
        //get records of all sales
        //$sales = Sale::all();

        $sales = DB::table('sales')
            ->leftJoin('customers', 'sales.customerID', '=', 'customers.id')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select('sales.id', 'customers.firstName', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'sales.totalBill')
            ->whereDate('sales.created_at', '>=', Carbon::today())
            ->get();

        $totalCustomers = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->whereDate('sales.created_at', '>=', Carbon::today())
            ->count();

        $totalProductsSold = DB::table('sales')
            ->select(DB::raw('SUM(purchaseQuantity) as totalSold'))
            ->whereDate('sales.created_at', '>=', Carbon::today())
            ->get();

        $totalCost = DB::table('sales')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select(DB::raw('SUM(products.productBuyingPrice * sales.purchaseQuantity) as totalCost'))
            ->whereDate('sales.created_at', '>=', Carbon::today())
            ->get();

        $totalSaleCost = DB::table('sales')
            ->select(DB::raw('SUM(totalBill) as totalBill'))
            ->whereDate('sales.created_at', '>=', Carbon::today())
            ->get();

        //with get(), we get Collection and with first() or find(), we get object
        //accessing Collection and accessing Object is little bit different
        //https://stackoverflow.com/questions/41366092/laravel-property-title-does-not-exist-on-this-collection-instance
        //finding the profit
        $totalProfit = $totalSaleCost[0]->totalBill - $totalCost[0]->totalCost;

        //finding profit percentage
        $profitPercentage = round(($totalProfit * 100) / $totalCost[0]->totalCost);
//        $profitPercentage = round(($totalProfit / $totalCost[0]->totalCost ) * 100);

        $topCustomersByExpense = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.totalBill) as totalExpense'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalExpense', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::today())
            //->limit('1')
            ->get();

        $topCustomersByProductQt = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.purchaseQuantity) as totalQuantity'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::today())
            //->limit('1')
            ->get();

        $topSellingProducts = DB::table('products')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'categories.categoryName as categoryNamee', 'products.productCategoryID', DB::raw('SUM(sales.purchaseQuantity) as sellingQuantity'))
            ->groupBy('products.id', 'products.productName', 'products.productCategoryID', 'categories.categoryName')
            ->orderBy('sellingQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::today())
            //->limit('1')
            ->get();

        return view('panel.sale.viewTodaySales')
            ->with('sales', $sales)
            ->with('totalCustomers', $totalCustomers)
            ->with('totalProductsSold', $totalProductsSold)
            ->with('totalCost', $totalCost)
            ->with('totalSaleCost', $totalSaleCost)
            ->with('totalProfit', $totalProfit)
            ->with('profitPercentage', $profitPercentage)
            ->with('topCustomersByExpense', $topCustomersByExpense)
            ->with('topCustomersByProductQt', $topCustomersByProductQt)
            ->with('topSellingProducts', $topSellingProducts);
    }

    public function viewYesterdaySales()
    {
        //get records of all sales
        //$sales = Sale::all();
        $sales = DB::table('sales')
            ->leftJoin('customers', 'sales.customerID', '=', 'customers.id')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select('sales.id', 'customers.firstName', 'customers.lastName', 'products.productName', 'products.productModel', 'sales.purchaseQuantity', 'products.productSellingPrice', 'sales.totalBill')
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            ->get();

        $totalCustomers = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            ->count();

        $totalProductsSold = DB::table('sales')
            ->select(DB::raw('SUM(purchaseQuantity) as totalSold'))
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            ->get();

        $totalCost = DB::table('sales')
            ->leftJoin('products', 'sales.productID', '=', 'products.id')
            ->select(DB::raw('SUM(products.productBuyingPrice * sales.purchaseQuantity) as totalCost'))
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            ->get();

        $totalSaleCost = DB::table('sales')
            ->select(DB::raw('SUM(totalBill) as totalBill'))
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            ->get();

        //with get(), we get Collection and with first() or find(), we get object
        //accessing Collection and accessing Object is little bit different
        //https://stackoverflow.com/questions/41366092/laravel-property-title-does-not-exist-on-this-collection-instance
        //finding the profit
        $totalProfit = $totalSaleCost[0]->totalBill - $totalCost[0]->totalCost;

        //finding profit percentage
        $profitPercentage = round(($totalProfit * 100) / $totalCost[0]->totalCost);
//        $profitPercentage = round(($totalProfit / $totalCost[0]->totalCost ) * 100);

        $topCustomersByExpense = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.totalBill) as totalExpense'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalExpense', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            //->limit('1')
            ->get();

        $topCustomersByProductQt = DB::table('customers')
            ->leftJoin('sales', 'customers.id', '=', 'sales.customerID')
            ->select('customers.id', 'customers.firstName', 'customers.lastName', DB::raw('SUM(sales.purchaseQuantity) as totalQuantity'))
            ->groupBy('customers.id', 'customers.firstName', 'customers.lastName')
            ->orderBy('totalQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            //->limit('1')
            ->get();

        $topSellingProducts = DB::table('products')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'categories.categoryName as categoryNamee', 'products.productCategoryID', DB::raw('SUM(sales.purchaseQuantity) as sellingQuantity'))
            ->groupBy('products.id', 'products.productName', 'products.productCategoryID', 'categories.categoryName')
            ->orderBy('sellingQuantity', 'desc')
            ->whereDate('sales.created_at', '>=', Carbon::yesterday())
            //->limit('1')
            ->get();

        return view('panel.sale.viewYesterdaySales')
            ->with('sales', $sales)
            ->with('totalCustomers', $totalCustomers)
            ->with('totalProductsSold', $totalProductsSold)
            ->with('totalCost', $totalCost)
            ->with('totalSaleCost', $totalSaleCost)
            ->with('totalProfit', $totalProfit)
            ->with('profitPercentage', $profitPercentage)
            ->with('topCustomersByExpense', $topCustomersByExpense)
            ->with('topCustomersByProductQt', $topCustomersByProductQt)
            ->with('topSellingProducts', $topSellingProducts);
    }

    public function saleDetails()
    {
        return view('panel.sale.saleDetails');
    }
}


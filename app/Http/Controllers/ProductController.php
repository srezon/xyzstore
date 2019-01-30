<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use App\Sale;
use DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function newProduct()
    {
//        $categories = Category::where('publicationStatus', 1)->get();
        $categories = Category::all();
        $brands = Brand::all();
        return view('panel.product.newProduct')
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('addMsg', 'Add new Product:');
    }

    public function saveProduct(Request $request)
    {
        //validation
        $this->validate($request, [
            'productName' => 'required',
            'productCategoryID' => 'required',
            //'productBrand' => 'required',
            'productQuantity' => 'required',
            'productSellingPrice' => 'required',
        ]);
        //EORM Method 1
        $product = new Product();
        $product->productName = $request->productName;
        $product->productModel = $request->productModel;
        $product->productCategoryID = $request->productCategoryID;
        $product->productBrandID = $request->productBrandID;
        $product->productQuantity = $request->productQuantity;
        $product->productBuyingPrice = $request->productBuyingPrice;
        $product->productSellingPrice = $request->productSellingPrice;
        $product->productNotes = $request->productNotes;
        $product->save();
        return redirect('/product/new')->with('successMsg', 'Product added to inventory successfully!');
    }

    public function editProduct($id)
    {
        $productByID = Product::where('id', $id)->first();
//        $categories = Category::where('publicationStatus', 1)->get();
        $categories = Category::all();
//        $ff = Category::
        $brands = Brand::all();
        //cannot bring category name

        $editMsg = "Edit the Product:";

        return view('panel.product.editProduct')
            ->with('productByID', $productByID)
            ->with('categories', $categories)
            ->with('brands', $brands)
            ->with('editMsg', $editMsg);


        //validation

    }

    public function updateProduct(Request $request)
    {

        $product = Product::find($request->productID);
        $product->productName = $request->productName;
        $product->productModel = $request->productModel;
        $product->productCategoryID = $request->productCategoryID;
        $product->productBrandID = $request->productBrandID;
        $product->productQuantity = $request->productQuantity;
        $product->productBuyingPrice = $request->productBuyingPrice;
        $product->productSellingPrice = $request->productSellingPrice;
        $product->productNotes = $request->productNotes;
        $product->save();

        return redirect('/products')->with('successMsg', 'Product Updated!');
    }

    public function viewProducts()
    {
//        $products = Product::all();

//previous query without SUM from slaes
//        $products = DB::table('products')
//            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
//            ->leftJoin('brands', 'products.productBrandID', '=', 'brands.id')
//            ->select('products.id', 'products.productName', 'products.productModel', 'products.productCategoryID', 'products.productBrandID', 'products.productQuantity', 'products.productSellingPrice', 'products.productNotes', 'categories.categoryName', 'brands.brandName')
//            ->get();
//
        //to solve "isn't Group by" error, I had to group by every column, https://stackoverflow.com/questions/25800411/mysql-isnt-in-group-by
        //used IFNULL to replace NULL value to 0, https://stackoverflow.com/questions/7602271/how-do-i-get-sum-function-in-mysql-to-return-0-if-no-values-are-found
        $products = DB::table('products')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->leftJoin('brands', 'products.productBrandID', '=', 'brands.id')
            ->leftJoin('sales', 'products.id', '=', 'sales.productID')
            ->select( 'products.id', 'products.productName', 'products.productModel', 'products.productCategoryID', 'products.productBrandID', 'products.productQuantity', 'products.productSellingPrice', 'products.productNotes', 'categories.categoryName', 'brands.brandName', DB::raw('IFNULL(SUM(sales.purchaseQuantity), 0) as productTotalSold'))
            ->groupBy('products.id', 'products.productName', 'products.productModel', 'products.productCategoryID', 'products.productBrandID', 'products.productQuantity', 'products.productSellingPrice', 'products.productNotes', 'products.created_at', 'products.updated_at', 'categories.categoryName', 'brands.brandName' )
            ->get();


        //to solve "isn't Group by" error, I had to group by every column, https://stackoverflow.com/questions/25800411/mysql-isnt-in-group-by
        //done with raw sql
//        $products = DB::select('SELECT products.*, SUM(sales.purchaseQuantity) FROM products LEFT JOIN sales ON (sales.productID = products.id) GROUP BY products.id, products.productName, products.productModel, products.productCategoryID, products.productBrandID, products.productQuantity, products.productSellingPrice, products.productNotes, products.created_at, products.updated_at');

        return view('panel.product.viewProducts')
            ->with('products', $products)
            ->with('firstMsg', 'Available Products:');
    }

    public function productDetails()
    {
        return view('panel.product.productDetails');
    }

    public function productCharts()
    {
        return view('panel.product.productCharts');
        //return view('panel.product.productCharts');
    }

    public function productChartData()
    {

        $products = DB::table('products')->get();
        $all_products = $products->all();
        return json_encode($all_products);

    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products/')
            ->with('successMsg', 'Product removed successfully')
            ->with('id', $id);
    }

    public function findProduct(Request $request)
    {
        $foundProduct = Product::find($request);

        $foundProductCategoryID = $foundProduct->productCategoryID;
        //way 1, found at https://laracasts.com/discuss/channels/eloquent/select-specific-columns-using-eloquent-orm
        $foundProductCategoryName = Category::where('id', '=', $foundProductCategoryID)
            ->first(['categoryName']);

        $foundProductBrandID = $foundProduct->productBrandID;
        //way 2, found at https://laracasts.com/discuss/channels/eloquent/select-specific-columns-using-eloquent-orm
        $foundProductBrandName = Brand::where('id', '=', $foundProductBrandID)
            ->select('brandName')
            ->first();

        $products = DB::table('products')
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->leftJoin('brands', 'products.productBrandID', '=', 'brands.id')
            ->select('products.id', 'products.productName', 'products.productModel', 'products.productCategoryID', 'products.productBrandID', 'products.productQuantity', 'products.productSellingPrice', 'products.productNotes', 'categories.categoryName', 'brands.brandName')
            ->get();

        return view('panel.product.foundProduct')
            ->with('foundProduct', $foundProduct)
            ->with('foundProductCategoryName', $foundProductCategoryName)
            ->with('foundProductBrandName', $foundProductBrandName)
            ->with('products', $products);
    }
}

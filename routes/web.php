<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WelcomeController@index');
Route::get('/panel', 'PanelController@index');


Auth::routes();
Route::get('/home', 'HomeController@index');



//CATEGORY ROUTES
//add
Route::get('/category/new', 'CategoryController@newCategory');
Route::post('/category/save', 'CategoryController@saveCategory');
//Route::get('/category/', function () {
//    return redirect('/categories/');
//});
//edit
Route::get('/category/edit/{id}', 'CategoryController@editCategory');
Route::post('/category/update', 'CategoryController@updateCategory');
Route::get('/category/delete/{id}', 'CategoryController@deleteCategory');
//view
Route::get('/categories/', 'CategoryController@viewCategories');

//VIEW PRODUCTS by CATEGORY
Route::get('/category/{id}', 'CategoryController@productsByCategory');




//PRODUCT ROUTES
//add
Route::get('/product/new', 'ProductController@newProduct');
Route::post('/product/save', 'ProductController@saveProduct');
//Route::get('/product/', function () {
   // return redirect('/products/');
//});
//edit
Route::get('/product/edit/{id}', 'ProductController@editProduct');
Route::post('/product/update', 'ProductController@updateProduct');
Route::get('/product/delete/{id}', 'productController@deleteProduct');
//view
Route::get('/products/', 'ProductController@viewProducts');
Route::get('/product/{id}', 'ProductController@productDetails');
//delete
//search
Route::get('/productfind/do/', 'ProductController@findProduct');
//reports
Route::get('/productreports/', 'ProductController@productReports');
Route::get('/productchartdata/', 'ProductController@productChartData');




//BRAND ROUTS
//add
Route::get('/brand/new', 'BrandController@newBrand');
Route::post('/brand/save', 'BrandController@saveBrand');
Route::get('/brand/', function () {
    return redirect('/brands/');
});
//view
Route::get('/brands/', 'BrandController@viewBrands');
//VIEW PRODUCTS by Brand
Route::get('/brand/{id}', 'BrandController@productsByBrand');

//edit
Route::get('/brand/edit/{id}', 'BrandController@editBrand');
Route::post('/brand/update/', 'BrandController@updateBrand');




//SALE ROUTES
//add
Route::get('/sale/new/', 'SaleController@newSale');
Route::get('/sale/do/', 'SaleController@doSale');
Route::post('/sale/save/', 'SaleController@saveSale');
Route::get('/sale/save/', function () {
    return redirect('/sales/new/');
});
Route::get('/sale/', function () {
    return redirect('/sales/');
});
Route::post('/sale/new/', 'SaleController@saveSale');

//view
Route::get('/sales/', 'SaleController@viewSales');
Route::get('/sale/{id}', 'SaleController@saleDetails');

Route::get('/sales/thismonth/', 'SaleController@viewThisMonthSales');
Route::get('/sales/lastmonth/', 'SaleController@viewLastMonthSales');
Route::get('/sales/thisweek/', 'SaleController@viewThisWeekSales');
Route::get('/sales/lastweek/', 'SaleController@viewLastWeekSales');
Route::get('/sales/today/', 'SaleController@viewTodaySales');
Route::get('/sales/yesterday/', 'SaleController@viewYesterdaySales');




//CUSTOMER ROUTES
//add
Route::get('/customer/new', 'CustomerController@newCustomer');
Route::post('/customer/save', 'CustomerController@saveCustomer');
Route::get('/customer/save', function () {
    return redirect('/customers/new');
});
Route::get('/customer/', function () {
    return redirect('/customers/');
});

//view
Route::get('/customers/', 'CustomerController@viewCustomers');
Route::get('/customer/do/', 'CustomerController@findCustomer');
//edit
Route::get('/customer/edit/{id}', 'CustomerController@editCustomer');
//sell to specific customer
Route::get('/customer/{id}', 'CustomerController@sellToCustomer');


//INVOICE ROUTES
Route::get('/invoices/', 'InvoiceController@viewInvoices');
Route::get('/invoice/{id}', 'InvoiceController@viewInvoiceDetails');
Route::get('/invoice/makeDelivered/{id}', 'InvoiceController@makeInvoiceDelivered');


//Supplier Routes
Route::get('supplier/new', 'SupplierController@create');
Route::post('supplier/save', 'SupplierController@store');


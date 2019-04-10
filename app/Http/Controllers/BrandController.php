<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Brand;
use App\Product;
class BrandController extends Controller
{
    public function newBrand()
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        return view('panel.brand.newBrand');
    }

    public function saveBrand(Request $request)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }

        $this->validate($request, [
            'brandName' => 'required'

        ]);

        $brand = new Brand();
        $brand->brandName = $request->brandName;
        $brand->brandNotes = $request->brandNotes;
        $brand->save();

        return redirect('/brand/new')->with('successMsg', 'Brand Added successfully!');
    }

    public function viewBrands()
    {
        $brands = Brand::all();
        return view('panel.brand.viewBrands')
            ->with('brands', $brands);
    }

    public function editBrand($id)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $brandByID = Brand::where('id', $id)->first();
        return view('panel.brand.editBrand')
            ->with('brandByID', $brandByID)
            ->with('Msg', 'Edit this Brand:');
    }

    public function updateBrand(Request $request)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $brandByID = Brand::find($request->id);
        $brandByID->brandName = $request->brandName;
        $brandByID->brandNotes = $request->brandNotes;
        $brandByID->save();
        return redirect('/brands/')->with('successMsg', 'Brand Updated Successfully!');
    }

    public function productsByBrand($id){
        $productBrand = Brand::where('id', $id)->first();
        $productsByBrand = Product::where('productBrandID', $id)
            ->leftJoin('categories', 'products.productCategoryID', '=', 'categories.id')
            ->select('products.id', 'products.productName', 'products.productModel', 'products.productCategoryID', 'products.productQuantity', 'products.productPrice', 'products.productNotes', 'categories.categoryName')
            ->get();

        return view('panel.brand.productsByBrand')
            ->with('productsByBrand', $productsByBrand)
            ->with('productBrand', $productBrand);
    }
}

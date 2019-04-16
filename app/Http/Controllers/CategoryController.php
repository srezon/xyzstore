<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryController extends Controller
{
    public function newCategory()
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        return view('panel.category.newCategory');
    }

    //in following, Request is a class and $request is an object.
    public function saveCategory(Request $request)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $this->validate($request, [
            'categoryName' => 'required',
            'categoryDescription' => 'required',
        ]);

        //return $request->all();

        //Eloquent process 1
        //was working without $fillable property in Category.php model
        //save() is a function of elequent class

        $category = new Category();
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
//        $category->publicationStatus = $request->publicationStatus;
        $category->save();
//        return 'Category info save successfully';

        //elequent process 2
        //we need a $fillable propery in model file
//        Category::create( $request->all() );
//         return 'Category info save successfully';


//with query builder
//        DB::table('categories')->insert([
//            'categoryName' => $request->categoryName,
//            'categoryDescription' => $request->categoryDescription,
//            'publicationStatus' => $request->publicationStatus,
//        ]);


        //return redirect()->back();
        return redirect('/category/new')->with('message', 'Category info saved successfully');
    }

    public function viewCategories()
    {
        $categories = Category::all();
        return view('panel.category.viewCategories', ['categories' => $categories]);
    }

    public function editCategory($id)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        // return "Hello";
        $categoryByID = Category::where('id', $id)->first();

        return view('panel.category.editCategory', ['categoryByID' => $categoryByID]);
    }

    public function updateCategory(Request $request)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        // return "Hello";
        $category = Category::find($request->categoryId);
        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
//        $category->publicationStatus = $request->publicationStatus;
        $category->save();
        return redirect('/categories/')->with('message', 'Category info updated successfully');
    }

    public function productsByCategory($id)
    {
        $productCategory = Category::where('id', $id)->first();
        $productsByCategory = Product::where('productCategoryID', $id)
            ->leftJoin('brands', 'products.productBrandID', '=', 'brands.id')
            ->select('products.id', 'products.productName', 'products.productModel', 'products.productBrandID', 'products.productQuantity', 'products.productPrice', 'products.productNotes', 'brands.brandName')
            ->get();

        return view('panel.category.productsByCategory')
            ->with('productsByCategory', $productsByCategory)
            ->with('productCategory', $productCategory)
            ;
    }

    public function deleteCategory($id)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }

        if (Product::where('productCategoryID', $id)->exists()) {
            return redirect('/categories/')->with('message', 'This Category has Product and cannot be deleted');
        }else{
            Category::destroy($id);
            return redirect('/categories/')->with('message', 'The Category has been deleted!');
        }
    }

}

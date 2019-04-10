<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::with('brand')->get();
        return view('panel.supplier.viewSuppliers')->with('suppliers', $suppliers);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $brands = Brand::doesntHave('supplier')->get();
        return view('panel.supplier.newSupplier')->with('brands', $brands)->with('addMsg', 'Add new Supplier:');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $this->validate($request, [
            'supplierName' => 'required',
            'supplierPhone' => 'required',
            'brandID' => 'required',
            'supplierAddress' => 'required',
        ]);

        $newSupplier = new Supplier();
        $newSupplier->supplierName = $request->supplierName;
        $newSupplier->supplierPhone = $request->supplierPhone;
        $newSupplier->supplierEmail = $request->supplierEmail;
        $newSupplier->brand_id = $request->brandID;
        $newSupplier->supplierAddress = $request->supplierAddress;
        $newSupplier->save();

        return redirect()->back()->with('successMsg', "Supplier has been updated!")->with('suppliers', Supplier::all());


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $supplier = Supplier::find($id);
        $brand = Brand::find($supplier->brand_id);

        $editMsg = "Edit the Supplier:";

        return view('panel.supplier.editSupplier')
            ->with('brand', $brand)
            ->with('supplier', $supplier)
            ->with('editMsg', $editMsg);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (\Auth::user()->role_id == 2) {
            return view('panel.user.noAccess');
        }
        $supplier = new Supplier();
        $supplier->find($id)->fill($request->all())->save();
        return view('panel.supplier.viewSuppliers')->with('successMsg', "Supplier has been updated!")->with('suppliers', $supplier->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}

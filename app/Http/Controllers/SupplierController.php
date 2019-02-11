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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $brands = Brand::all();
        return view('panel.supplier.newSupplier')->with('brands', $brands)->with('addMsg', 'Add new Supplier:');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        return $request->all();
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

        return 'SUpplier Added';

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}

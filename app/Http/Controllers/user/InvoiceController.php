<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Sale;
use Illuminate\Http\Request;
use DataTables;
use DB;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.invoice.index');
    }
    public function data()
    {
        $userId = auth()->id();
        $sales = Sale::select(['sales.id', 'customers.name', 'sales.total_amount', 'sales.created_at'])
            ->join('customers', 'customers.id', '=', 'sales.customer_id')
            ->where('sales.user_id', $userId)
            ->get();


        return Datatables::of($sales)->make(true);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $userId = auth()->id();
        $sales = Sale::where('user_id', $userId)
            ->where('id', $id)
            ->with('customer')
            ->with('salesitems.product')
            ->get();
        return view('user.invoice.show', compact('sales'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

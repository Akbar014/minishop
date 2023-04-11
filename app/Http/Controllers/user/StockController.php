<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DataTables;
use DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.stock.index');
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
    
    public function data()
    {
        $userId = auth()->id();
        $products = Product::select(['id', 'name', 'purchase_price', 'sales_price', 'quantity', 'left_quantity', 'unit', 'description', 'image'])
    ->where('user_id', $userId)
    ->withCount(['saleItems'])
    ->get();

foreach ($products as $product) {
    $product->total_quantity_sold = $product->saleItems->sum('quantity');
}

    return DataTables::of($products)->make(true);
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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

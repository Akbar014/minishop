<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\Saleitem;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();
        $products = Product::select(['id', 'name', 'purchase_price', 'sales_price', 'quantity', 'description', 'image'])
            ->where('user_id', $userId)
            ->get();
        $customers = Customer::select(['id', 'name', 'phone', 'address'])
            ->where('user_id', $userId)
            ->get();
        return view('user.sale.index', compact('products', 'customers'));
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
        // dd($request->all());
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',

            'total_amount' => 'required|numeric|min:0',
            'product_id.*' => 'required|exists:products,id',
            'quantity.*' => 'required|integer|min:1',
            
            'total.*' => 'required|numeric|min:0'
        ]);
        $userId = auth()->id();
        $sale = Sale::insertGetId([
            'customer_id' => $validatedData['customer_id'],
            'user_id' => $userId,
            'total_amount' => $validatedData['total_amount'],
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $lastInsertId = $sale;

        for ($i = 0; $i < count($request['product_id']); $i++) {
            Saleitem::insert([
                'sale_id' => $lastInsertId,
                'product_id' => $request['product_id'][$i],
                'quantity' => $validatedData['quantity'][$i],
                
                'total_price' => $request['total'][$i]
            ]);

            $product = Product::find($request['product_id'][$i]);
            $product->left_quantity -= $validatedData['quantity'][$i];
            $product->save();
        }

        return redirect()->route('user.sale.index')->with('success', 'Invoice created successfully');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sale = Sale::find($id);
        $saleitem = Saleitem::find($id);
        return view('user.sale.show', compact('sale', 'saleitem'));
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

<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'nullable',
            
        ]);
        
        // Create a new product instance
        $customer = new Customer;
        $customer->name = $validatedData['name'];
        $customer->phone = $validatedData['phone'];
        $customer->address = $validatedData['address']; 
        $customer->user_id = auth()->user()->id;
        $customer->save();
        return response()->json(['success' => true, 'message' => 'Customer added successfully.']);
        // return redirect()->route('user.sale.index')->with('success', 'Cusromer added successfully.');
    }

    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findorFail($id);
        return $customer;
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

<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use DataTables;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $products = Product::all();
        return view('user.product.index');
    }
    public function data()
    {
        
        $userId = auth()->id();
        $products = Product::select(['id', 'name', 'purchase_price', 'sales_price', 'quantity', 'unit', 'description', 'image'])
            ->where('user_id', $userId)
            ->get();

        

        return Datatables::of($products)->make(true);
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
    // Validate the form data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'unit' => 'required|string',
        'purchase_price' => 'required|numeric|min:0',
        'sales_price' => 'required|numeric|min:0',
        'image' => 'nullable|image',
    ]);
    

    // Create a new product instance
    $product = new Product;
    $product->name = $validatedData['name'];
    $product->description = $validatedData['description'];
    $product->quantity = $validatedData['quantity'];
    $product->left_quantity = $validatedData['quantity'];
    $product->unit = $validatedData['unit'];
    $product->purchase_price = $validatedData['purchase_price'];
    $product->sales_price = $validatedData['sales_price'];
    $product->user_id = auth()->user()->id;

    // Handle image upload if provided
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('images/products/' . $filename);
        Image::make($image)->resize(300, 300)->save($location);
        $product->image = $filename;
        
    }

   
    $product->save();

    
    return response()->json(['success' => true, 'message' => 'Product added successfully.']);
    
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findorFail($id);
        return $product;
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

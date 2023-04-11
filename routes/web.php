<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\User;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\user\ProductController;
use App\Http\Controllers\user\SaleController;
use App\Http\Controllers\user\CustomerController;
use App\Http\Controllers\user\InvoiceController;
use App\Http\Controllers\user\StockController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();




Route::resource('product', ProductController::class);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('home');

// Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('CheckRole');
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    
    Route::resource('product', ProductController::class);
    Route::resource('sale', SaleController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('invoice', InvoiceController::class);
    Route::resource('stock', StockController::class);
    
    Route::get('invoices/print', [InvoiceController::class,'print'])->name('invoices.print');
    Route::get('/customer/details/{id}', [CustomerController::class,'details'])->name('customer.details');
    Route::get('invoices/data', [InvoiceController::class,'data'])->name('invoices.data');
    Route::get('products/data', [ProductController::class,'data'])->name('products.data');
    Route::get('stocks/data', [StockController::class,'data'])->name('stocks.data');
    // Route::get('invoice/data1', [InvoiceController::class,'invoicedata'])->name('invoices.data');
    // Route::get('/product/details/{id}', [ProductController::class,'show'])->name('product.details');

    
    
    // Other admin routes can be added here
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('home');
    Route::post('admin/user/register', [HomeController::class, 'userregister'])->name('register');
    Route::get('product', [HomeController::class, 'product'])->name('products');
    Route::get('users/data', [HomeController::class, 'data'])->name('users.data');
    // Other admin routes can be added here
});

<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId = auth()->id();
        $total_product = Product::where('user_id',$userId)->count();
        $invoice = Sale::where('user_id',$userId)->count();
        return view('user.home',compact('total_product','invoice'));
    }
    public function adminHome()
    {
        
        return view('admin.home');
    }

    public function userregister(Request $request){
        // dd($request->all());
        $user = new User;
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['role_id'] = 1;
        $user['password'] = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('message','New user created Sucessfully');
    }

    public function product(){
        dd('Upcoming ');
    }

    public function data()
    {

        $users = User::select(['id', 'name', 'email'])
        
        ->get();
        return Datatables::of($users)->make(true);
    }
}

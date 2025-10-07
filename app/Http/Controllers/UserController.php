<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        if(Auth::check()){
            if(Auth::user()->user_type=='user'){
                return view('dashboard');
            }
            else if(Auth::user()->user_type=='admin'){
            return view('admin.dashboard');
            }
        }
    }
    public function home(){
        $products = Product::all();
        return view('index',compact('products')); 

    }

    public function productDetails($id){
        $product = Product::findOrFail($id);
        return view('product_details',compact('product'));
    }
}

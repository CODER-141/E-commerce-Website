<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

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
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        $products = Product::latest()->take(3)->get();
        return view('index',compact('products','count')); 

    }

    public function productDetails($id){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        $product = Product::findOrFail($id);
        return view('product_details',compact('product','count'));
    }

    public function allProducts(){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
        }else{
            $count = '';
        }
        $products =Product::all();
        return view('allproducts',compact('products','count'));
    }

    public function addToCart($id){
        $product = Product::findOrFail($id);
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $product->id;

        $product_cart->save();
        return redirect()->back()->with('cart_message','Product added to the cart successfully!');
    }

    public function cartproducts(){
        if(Auth::check()){
            $count = ProductCart::where('user_id',Auth::id())->count();
            $cart = ProductCart::where('user_id',Auth::id())->get();
        }else{
            $count = '';
        }
        return view('viewcartproducts',compact('count','cart'));
    }

    public function removeCartProduct($id){
        $cart_product = ProductCart::findOrFail($id);
        $cart_product->delete();
        return redirect()->back()->with('cart_message','Product removed from the cart successfully!');
    }

    public function confirmOrder(Request $request){

        $cart_product_id = ProductCart::where('user_id',Auth::id())->get();
        $address = $request->receiver_address;
        $phone = $request->receiver_phone;

        foreach($cart_product_id as $cart_product){
            $order = New Order();
            $order->receiver_address = $address;
            $order->receiver_phone = $phone;
            $order->user_id = Auth::id();
            $order->product_id = $cart_product->product_id;
            $order->save();
        }

        $cart = ProductCart::where('user_id',Auth::id())->get();
        foreach($cart as $cart){
            $cart_id = ProductCart::findOrFail($cart->id);
            $cart_id->delete();
        }
        return redirect()->back()->with('confirm_order','Order Confirmed');

    }

    public function myOrders(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('viewmyorders',compact('orders'));
    }
}

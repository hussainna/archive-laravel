<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request){
        $product_id=$request->input('prod_id');
        $cart=Cart::where('user_id',Auth::id())->get();
        return view('website.pages.cart',compact('cart'));
    }
    public function insertCart(Request $request){
        $product_id=$request->input('prod_id');

        if(Auth::check()){
            $prod_id=Product::where('id',$product_id)->first();
            if($prod_id){
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists())
                {
                    return response()->json(['status'=>'Aleady Added To Cart']);
                }
                else
                {
                    $cart=new Cart();
                    $cart->prod_id=$product_id;
                    $cart->user_id=Auth::id();
                    $cart->qty=$request->input('qty');
                    $cart->save();
                    return response()->json(['status'=>'Added To Cart']);
                }
            }
        }
        else{
            return response()->json('stat','login firest');
        }

    }
    public function remove(Request $request){
        $cart_id=$request->input('cart_id');
        $cart=Cart::where('id',$cart_id)->where('user_id',Auth::id())->first();
        $cart->delete();
    }

}

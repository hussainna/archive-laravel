<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index(){
        $cart=Cart::where('user_id',Auth::id())->get();
        return view('website.pages.chekout',compact('cart'));
    }
    public function insert(Request $request){
        $check=new Order();
        $check->name=$request->name;
        $check->lname=$request->lname;
        $check->email=$request->email;
        $check->password=$request->password;
        $check->address=$request->address;
        $check->phone=$request->phone;
        $check->country=$request->country;
        $check->city=$request->city;
        $check->save();
        $orderItem=Cart::where('user_id',Auth::id())->get();
        foreach($orderItem as $o){
            OrderItem::create([
                'order_id'=>$o->user_id,
                'prod_id'=>$o->prod_id,
                'price'=>$o->product->price,
            ]);
        }
        return redirect('/');
    }
}

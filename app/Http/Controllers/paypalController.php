<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;

class paypalController extends Controller
{
    public function payment(Request $request){
        $cart=Cart::where('user_id',Auth::id())->get();
        $total=$request->input('total');
        $data=[];
        $data['items']=[
            [
                'name'=>'apple',
                'price'=>100,
                'qty'=>1,
            ]
        ];
        $data['invoice_id']=1;
        $data['invoice_description']="Order #{data[invoice_id]} invoice";
        $data['return_url']=route('payment.success');
        $data['cancel_url']=route('payment.cancel');
        $data['total']=$total;

        $provider=new ExpressCheckout();
        $response=$provider->setExpressCheckout($data);
        $response=$provider->setExpressCheckout($data,true);
        return redirect($response['paypal_link']);
    }
    public function cancel(){
        dd('you are cancled');
    }
    public function success(Request $request){
        $provider=new ExpressCheckout();
        $response=$provider->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']),['SUCCESS','SUCCESSWITHWARNING'])){
            dd('your payment are success');
        }
        dd('please try again');

    }


}

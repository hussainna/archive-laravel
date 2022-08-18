<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class singleprodController extends Controller
{
    public function index($id){
        $product=Product::find($id);
        return view('website.pages.singleprod',compact('product'));
    }
}

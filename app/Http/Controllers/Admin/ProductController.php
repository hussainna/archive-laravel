<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(){
        $product=Product::all();
        return view('admin.sidebar.product',compact('product'));
    }
    public function add(){
        return view('admin.sidebar.addproduct');
    }
    public function insert(Request $request){
        $product=new Product();
        if($request->hasFile('img')){
            $file=$request->file('img');
            $ext=$file->getClientOriginalExtension();
            $fileName=time().'.'.$ext;
            $file->move('uploads/img',$fileName);
            $product->img=$fileName;
        }
        $product->name=$request->name;
        $product->price=$request->price;
        $product->save();
        return redirect('/Admin-Product');
    }
    public function remove($id){
        $product=Product::find($id);
        $product->delete();
        return redirect('/Admin-Product');
    }
    public function edit($id){
        $product=Product::find($id);
        return view('admin.sidebar.edit',compact('product'));
    }
    public function update(Request $request,$id){
        $product=Product::find($id);
        if($request->hasFile('img')){
            if(File::exists('img')){
                File::delete('img');
            }
            $file=$request->file('img');
            $ext=$file->getClientOriginalExtension();
            $fileName=time().'.'.$ext;
            $file->move('uploads/img',$fileName);
            $product->img=$fileName;
        }
        $product->name=$request->name;
        $product->price=$request->price;
        $product->update();
        return redirect('/Admin-Product');
    }
}

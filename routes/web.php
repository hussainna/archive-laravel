<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\paypalController;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; // Import the Request class


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/',function(){
    if(Auth::check())
    {
        return view('admin.index');
    }
    else
    {
        return view('auth.login');
    }
});


Route::get('/images',function(){

    if(Auth::check())
    {
        $images=DB::table('images')->where('user_id',Auth::id())->get();
        return view('admin.imageSidebar.index',compact('images'));
    }
    else
    {
        return view('auth.login');
    }
});


Route::post('/insert-image',function(Request $request){
    if(Auth::check())
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/image', $fileName);
        
            DB::table('images')->insert([
                'image' => $fileName,
                'user_id'=>Auth::id(),
                'name' => $request->name
            ]);
        } 
        
        return redirect('/images');
    }
    else
    {
        return view('auth.login');

    }

});

Route::get('/download-image/{image}',function(Request $request,$image){
    if(Auth::check())
    {
        $filePath = public_path('uploads/image/'.$image); // Replace with the actual file path

        return response()->download($filePath);
    }
    else
    {
        return view('auth.login');

    }

});


Route::get('/video',function(){
    if(Auth::check())
    {
        $video=DB::table('video')->where('user_id',Auth::id())->get();

        return view('admin.videoSidebar.index',compact('video'));
    }
    else
    {
        return view('auth.login');
    }
});

Route::post('/insert-video',function(Request $request){
    if(Auth::check())
    {
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/video', $fileName);
        
            DB::table('video')->insert([
                'video' => $fileName,
                'user_id'=>Auth::id(),
                'name' => $request->name
            ]);
        } 
        
        return redirect('/video');
    }
    else
    {
        return view('auth.login');

    }

});

Route::get('/download-video/{video}',function(Request $request,$video){
    if(Auth::check())
    {
        $filePath = public_path('uploads/video/'.$video); // Replace with the actual file path

        return response()->download($filePath);
    }
    else
    {
        return view('auth.login');

    }

});

Route::get('/pdf',function(){
    if(Auth::check())
    {
        $pdf=DB::table('pdf')->where('user_id',Auth::id())->get();

        return view('admin.pdfFiles.index',compact('pdf'));
    }
    else
    {
        return view('auth.login');
    }
});

Route::post('/insert-pdf',function(Request $request){
    if(Auth::check())
    {
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            $ext = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $ext;
            $file->move('uploads/pdf', $fileName);
        
            DB::table('pdf')->insert([
                'pdf' => $fileName,
                'user_id'=>Auth::id(),
                'name' => $request->name
            ]);
        } 
        
        return redirect('/pdf');
    }
    else
    {
        return view('auth.login');

    }

});

Route::get('/download-pdf/{pdf}',function(Request $request,$pdf){
    if(Auth::check())
    {
        $filePath = public_path('uploads/pdf/'.$pdf); // Replace with the actual file path

        return response()->download($filePath);
    }
    else
    {
        return view('auth.login');

    }

});

// Route::middleware('auth')->group(function(){
//     Route::get('/cart','Website\CartController@index')->name('cart');
//     Route::get('/single-product/{id}','Website\singleprodController@index');
//     Route::post('/insert','Website\CartController@insertCart');
//     Route::post('/delete-cart','Website\CartController@remove');
//     Route::get('/check-out','Website\checkoutController@index');
//     Route::post('/place-order','Website\checkoutController@insert');
//     Route::post('/payment',[paypalController::class,'payment'])->name('payment');
//     Route::get('/cancel',[paypalController::class,'cancel'])->name('payment.cancel');
//     Route::get('/success',[paypalController::class,'success'])->name('payment.success');
// });
// Route::middleware(['isAdmin','auth'])->group(function(){
//     Route::get('/dashboard', 'Admin\HomeController@index');
//     Route::get('/Admin-Product', 'Admin\ProductController@index');
//     Route::get('/Add-Product', 'Admin\ProductController@add');
//     Route::post('/insert-product', 'Admin\ProductController@insert');
//     Route::get('/product-remove/{id}', 'Admin\ProductController@remove');
//     Route::get('/product-edit/{id}', 'Admin\ProductController@edit');
//     Route::put('/update-product/{id}', 'Admin\ProductController@update');
// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('layout');

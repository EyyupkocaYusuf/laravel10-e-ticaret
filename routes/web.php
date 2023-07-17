<?php

use App\Http\Controllers\frontend\PageHomeController;
use \App\Http\Controllers\frontend\PageController;
use \App\Http\Controllers\frontend\AjaxController;
use \App\Http\Controllers\frontend\CartController;
use \App\Http\Controllers\CustomAuthController;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'sitesetting'],function (){
    Route::get('/', [PageHomeController::class,'anasayfa'])->name('anasayfa');
    Route::get('/urunler',[PageController::class,'urunler'])->name('urunler');
    Route::get('/erkek/{slug?}',[PageController::class,'urunler'])->name('erkekurunler');
    Route::get('/kadin/{slug?}',[PageController::class,'urunler'])->name('kadinurunler');
    Route::get('/cocuk/{slug?}',[PageController::class,'urunler'])->name('cocukurunler');
    Route::get('/urunler/indirimli',[PageController::class,'inidirimliurunler'])->name('inidirimliurunler');

    Route::get('/urun/{slug}',[PageController::class,'urundetay'])->name('urundetay');
    Route::get('/hakkimizda',[PageController::class,'hakkimizda'])->name('hakkimizda');
    Route::get('/iletisim',[PageController::class,'iletisim'])->name('iletisim');
    Route::post('/iletisim/kaydet',[AjaxController::class,'contactPost'])->name('iletisim.post');

    Route::get('/sepet',[CartController::class,'index'])->name('sepet');
    Route::post('/sepet/ekle',[CartController::class,'add'])->name('sepet.add');
    Route::post('/sepet/remove',[CartController::class,'remove'])->name('sepet.remove');

    Auth::routes();

    Route::get('/login',[CustomAuthController::class,'login'])->name('login');
});



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

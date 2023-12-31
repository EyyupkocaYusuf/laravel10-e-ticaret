<?php


use App\Http\Controllers\backend\AboutController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ContactController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SettingController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\backend\DashboardController;
use \App\Http\Controllers\backend\SliderController;




Route::group(['middleware' => ['panelsetting','auth'], 'prefix' => 'panel','as' => 'panel.'],function (){
    Route::get('/', [DashboardController::class,'index'])->name('index');
    Route::prefix('/slider')->name('slider.')->group(function (){
        Route::get('/', [SliderController::class,'index'])->name('index');
        Route::get('/ekle', [SliderController::class,'create'])->name('create');
        Route::get('/{id}/edit', [SliderController::class,'edit'])->name('edit');
        Route::post('/store', [SliderController::class,'store'])->name('store');
        Route::put('/{id}/update', [SliderController::class,'update'])->name('update');
        Route::delete('/destroy', [SliderController::class,'destroy'])->name('destroy');
        Route::post('-status/update', [SliderController::class,'status'])->name('status');
    });

    Route::resource('/category', CategoryController::class)->except('destroy');
    Route::delete('/category/destroy', [CategoryController::class,'destroy'])->name('category.destroy');
    Route::post('/category-status/update', [CategoryController::class,'status'])->name('category.status');

    Route::get('/about',[AboutController::class,'index'])->name('about.index');
    Route::post('/about/update',[AboutController::class,'update'])->name('about.update');

    Route::prefix('/contact')->name('contact.')->group(function (){
        Route::get('/',[ContactController::class,'index'])->name('index');
        Route::get('/{id}/edit',[ContactController::class,'edit'])->name('edit');
        Route::put('/{id}/update',[ContactController::class,'update'])->name('update');
        Route::delete('/destroy', [ContactController::class,'destroy'])->name('destroy');
        Route::post('-status/update', [ContactController::class,'status'])->name('status');
    });

    Route::prefix('/order')->name('order.')->group(function (){
        Route::get('/',[OrderController::class,'index'])->name('index');
        Route::get('/{id}/edit',[OrderController::class,'edit'])->name('edit');
        Route::put('/{id}/update',[OrderController::class,'update'])->name('update');
        Route::delete('/destroy', [OrderController::class,'destroy'])->name('destroy');
        Route::post('-status/update', [OrderController::class,'status'])->name('status');
    });

    Route::resource('/setting', SettingController::class)->except('destroy');
    Route::delete('/setting/destroy', [SettingController::class,'destroy'])->name('setting.destroy');

    Route::resource('/product', ProductController::class)->except('destroy');
    Route::delete('/product/destroy', [ProductController::class,'destroy'])->name('product.destroy');


});



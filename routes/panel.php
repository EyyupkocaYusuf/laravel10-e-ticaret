<?php


use App\Http\Controllers\backend\CategoryController;
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
});



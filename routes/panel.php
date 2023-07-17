<?php



use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\backend\DashboardController;
use \App\Http\Controllers\backend\SliderController;




Route::group(['middleware' => ['panelsetting','auth'], 'prefix' => 'panel','as' => 'panel.'],function (){
    Route::get('/', [DashboardController::class,'index'])->name('index');
    Route::resource('/slider', SliderController::class);
});

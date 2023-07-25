<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;

class PageHomeController extends Controller
{
    public function anasayfa()
    {
        $slider = Slider::whereStatus('1')->first();
        $title = 'Anasayfa';
        $abouts = About::whereId('1')->first();

        $lastProducts = Product::whereStatus('1')
            ->select(['id','name','slug','image','category_id','size','color','price','id'])
            ->with('category_relation')
            ->orderBy('id','desc')
            ->limit(10)
            ->get();
        return view('frontend.pages.index',compact('slider','title','abouts','lastProducts'));
    }

}

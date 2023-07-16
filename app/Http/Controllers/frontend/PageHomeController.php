<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Slider;

class PageHomeController extends Controller
{
    public function anasayfa()
    {
        $slider = Slider::whereStatus('1')->first();
        $title = 'Anasayfa';
        $abouts = About::whereId('1')->first();
        return view('frontend.pages.index',compact('slider','title','abouts'));
    }

}

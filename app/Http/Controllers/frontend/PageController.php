<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function urunler()
    {
        $categories = Category::whereStatus('1')->get();
        return view('frontend.pages.products',compact('categories'));
    }

    public function inidirimliurunler()
    {
        return view('frontend.pages.products');
    }

    public function urundetay()
    {
        return view('frontend.pages.product_details');
    }

    public function hakkimizda()
    {
        $abouts = About::whereId('1')->first();
        $categories = Category::whereStatus('1')->get();
        return view('frontend.pages.about',compact('categories','abouts'));
    }

    public function cart()
    {
        $categories = Category::whereStatus('1')->get();
        return view('frontend.pages.cart',compact('categories'));
    }

    public function iletisim()
    {
        $categories = Category::whereStatus('1')->get();
        return view('frontend.pages.contact',compact('categories'));
    }
}

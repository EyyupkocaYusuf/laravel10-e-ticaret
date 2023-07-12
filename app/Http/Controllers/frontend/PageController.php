<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function urunler()
    {
        return view('frontend.pages.products');
    }

    public function urundetay()
    {
        return view('frontend.pages.product_details');
    }

    public function hakkimizda()
    {
        return view('frontend.pages.about');
    }

    public function cart()
    {
        return view('frontend.pages.cart');
    }

    public function iletisim()
    {
        return view('frontend.pages.contact');
    }
}

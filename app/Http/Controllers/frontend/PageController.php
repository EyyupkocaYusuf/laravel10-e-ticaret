<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function urunler(Request $request)
    {
        $size = $request->size ?? '';
        $color = $request->color ?? '';
        $startprice = $request->start_price ?? '';
        $endprice = $request->end_price ?? '';
         $categories = Category::whereStatus('1')->where('cat_ust', null)->withCount('product_relation')->get();
        $products = Product::whereStatus('1')
            ->where(function($q) use($size,$color,$startprice,$endprice){
                if(!empty($size))
                {
                     $q->where('size',$size);
                }
                if(!empty($color))
                {
                     $q->where('color',$color);
                }
                if(!empty($startprice) && $endprice)
                {
                     $q->whereBetween('price',[$startprice,$endprice]);
                }
                return $q;
            })
            ->with('category_relation:id,name,slug');

            $minprice = $products->min('price');
            $maxprice = $products->max('price');

             $sizelists = Product::whereStatus('1')->groupBy('size')->pluck('size')->toArray();

             $colors = Product::whereStatus('1')->groupBy('color')->pluck('color')->toArray();

            $products = $products->paginate(1);
        return view('frontend.pages.products',compact('categories','products','minprice','maxprice','sizelists','colors'));
    }

    public function inidirimliurunler()
    {
        return view('frontend.pages.products');
    }

    public function urundetay($slug)
    {
        $categories = Category::whereStatus('1')->get();
        $product = Product::whereSlug($slug)->first();
        return view('frontend.pages.product_details',compact('categories','product'));
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

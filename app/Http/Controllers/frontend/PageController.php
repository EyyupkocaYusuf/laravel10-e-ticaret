<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function urunler(Request $request,$slug=null)
    {
        $category = request()->segment(1) ?? null ;

        $size = $request->size ?? '';

        $color = $request->color ?? '';

        $startprice = $request->start_price ?? '';
        $endprice = $request->end_price ?? '';

        $order = $request->order ?? 'id';

        $short = $request->short ?? 'desc';

        $products = Product::whereStatus('1')->select(['id','name','slug','size','color','category_id','price','image'])
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
            ->with('category_relation:id,name,slug')
            ->whereHas('category_relation', function ($q) use ($slug,$category){
                if(!empty($slug))
                {
                    $q->where('slug',$slug);
                }
                return $q;
            });


            $minprice = $products->min('price');
            $maxprice = $products->max('price');

             $sizelists = Product::whereStatus('1')->groupBy('size')->pluck('size')->toArray();

             $colors = Product::whereStatus('1')->groupBy('color')->pluck('color')->toArray();

            $products = $products->orderBy($order,$short)->paginate(20);
        return view('frontend.pages.products',compact('products','minprice','maxprice','sizelists','colors'));
    }

    public function inidirimliurunler()
    {
        return view('frontend.pages.products');
    }

    public function urundetay($slug)
    {
        $product = Product::whereSlug($slug)->whereStatus('1')->firstOrFail();

        $products = Product::where('id','!=',$product->id)
            ->where('category_id',$product->category_id)
            ->whereStatus('1')
            ->limit(6)
            ->get();
        return view('frontend.pages.product_details',compact('product','products'));
    }

    public function hakkimizda()
    {
        $abouts = About::whereId('1')->first();
        return view('frontend.pages.about',compact('abouts'));
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

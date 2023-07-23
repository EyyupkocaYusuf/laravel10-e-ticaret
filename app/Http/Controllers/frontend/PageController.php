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

        $sizes = !empty($request->size) ? explode(',', $request->size) : null;

        $colors = !empty($request->color) ? explode(',', $request->color) : null;


        $startprice = $request->min ?? null;
        $endprice = $request->max ?? null;

        $order = $request->order ?? 'slug';

        $sort = $request->sort ?? 'desc';

         $products = Product::whereStatus('1')->select(['id','name','slug','size','color','category_id','price','image'])
            ->where(function($q) use($sizes,$colors,$startprice,$endprice){
                if(!empty($sizes))
                {
                     $q->whereIn('size',$sizes);
                }
                if(!empty( $colors))
                {
                     $q->whereIn('color',$colors);
                }
                if(!empty($startprice) && $endprice)
                {
//                     $q->whereBetween('price',[$startprice,$endprice]);

                     $q->where('price','>=',$startprice);
                     $q->where('price','<=',$endprice);
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
            })->orderBy($order,$sort)->paginate(10);

            if($request->ajax()){
                $view = view('frontend.ajax.productList',compact('products'))->render();
                return response(['data' => $view,'paginate' =>(string) $products->withQueryString()->links('vendor.pagination.bootstrap-4')]);
            }

            $maxprice = Product::max('price');

            $sizelists = Product::whereStatus('1')->groupBy('size')->pluck('size')->toArray();

            $colors = Product::whereStatus('1')->groupBy('color')->pluck('color')->toArray();

        return view('frontend.pages.products',compact('products','maxprice','sizelists','colors'));
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

    public function iletisim()
    {
        return view('frontend.pages.contact');
    }
}

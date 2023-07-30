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

        $anakategori = null;
        $altkategori = null;
        if(!empty($category) && empty($slug)) {
            $anakategori = Category::whereSlug($category)->first();
        }else if(!empty($category) && !empty($slug)) {
            $anakategori = Category::whereSlug($category)->first();
            $altkategori = Category::whereSlug($slug)->first();
        }

        $breadcrumb = [
            'sayfalar' => [

            ],
            'active' => 'Ürünler',
        ];

        if(!empty($anakategori) && empty($altkategori)) {

            $breadcrumb['active'] = $anakategori->name ?? '';
        }

        if(!empty($altkategori)) {
            $breadcrumb['sayfalar'][] = [
                'link' => route($anakategori->slug.'urunler'),
                'name' => $anakategori->name
            ];
            $breadcrumb['active'] = $altkategori->name;
        }

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

        return view('frontend.pages.products',compact('breadcrumb','products','maxprice','sizelists','colors'));
    }

    public function inidirimliurunler()
    {
        $breadcrumb = [
            'sayfalar' => [

            ],
            'active' => 'İndiirmli Ürünler',
        ];
        return view('frontend.pages.products',compact('breadcrumb'));
    }

    public function urundetay($slug)
    {
        $product = Product::whereSlug($slug)->whereStatus('1')->firstOrFail();

        $products = Product::where('id','!=',$product->id)
            ->where('category_id',$product->category_id)
            ->whereStatus('1')
            ->limit(6)
            ->get();

        $breadcrumb = [
            'sayfalar' => [

            ],
            'active' => $product->name,
        ];
        return view('frontend.pages.product_details',compact('breadcrumb','product','products'));
    }

    public function hakkimizda()
    {
        $abouts = About::whereId('1')->first();
        $breadcrumb = [
            'sayfalar' => [

            ],
            'active' => 'Hakkımızda',
        ];
        return view('frontend.pages.about',compact('breadcrumb','abouts'));
    }

    public function iletisim()
    {
        $breadcrumb = [
            'sayfalar' => [

            ],
            'active' => 'İletişim',
        ];
        return view('frontend.pages.contact',compact('breadcrumb'));
    }
}

<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('backend.pages.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $product = Product::get();
        return view('backend.pages.product.create',compact('categories','product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyadi = time().'-'.Str::slug($request->name);
            $yukleKlasor = 'img/product/';

            $resimUrl = resimyukle($resim,$dosyadi,$yukleKlasor);
        }
        Product::create([
            'name' => $request->name,
            'image' =>$resimUrl ?? '',
            'category_id' =>$request->category_id,
            'short_text' =>$request->short_text,
            'price' =>$request->price,
            'qty' =>$request->qty,
            'status' =>$request->status,
            'color' =>$request->color,
            'size' =>$request->size,
            'content' =>$request->content,
        ]);

        return redirect()->route('panel.product.index')->withSuccess('Product başarılı bir şekilde Kaydedildi');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::whereId($id)->firstOrFail();
        return view('backend.pages.product.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::whereId($id)->firstOrFail();
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyadi = time().'-'.Str::slug($request->name);
            $yukleKlasor = 'img/product/';

            $resimUrl = resimyukle($resim,$dosyadi,$yukleKlasor);
        }
        $product->update([
            'name' => $request->name,
            'image' =>$resimUrl ?? $product->image,
            'category_id' =>$request->category_id,
            'short_text' =>$request->short_text,
            'price' =>$request->price,
            'qty' =>$request->qty,
            'status' =>$request->status,
            'color' =>$request->color,
            'size' =>$request->size,
            'content' =>$request->content,
        ]);

        return redirect()->route('panel.product.index')->withSuccess('Product başarılı bir şekilde Kaydedildi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $product = Product::whereId($request->id)->firstOrFail();
        dosyasil($product->image);
        $product->delete();
        return response(['error'=> false,'message'=>'Product başarılı bir şekilde Silindi']);
    }
}

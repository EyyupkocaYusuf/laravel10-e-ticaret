<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('category:id,cat_ust,name')->get();
        return view('backend.pages.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('backend.pages.category.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyadi = time().'-'.Str::slug($request->name);
            $yukleKlasor = 'img/kategori/';

            $resimUrl = resimyukle($resim,$dosyadi,$yukleKlasor);
        }

        Category::create([
            'name' => $request->name,
            'cat_ust' => $request->cat_ust,
            'status' => $request->status,
            'content' => $request->content,
            'image' => $resimUrl ?? '',
        ]);
        return redirect()->route('panel.category.index')->withSuccess('Kategori Başarılı bir şekilde oluşturuldu');
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
        $category = Category::whereId($id)->firstOrFail();
        $categories = Category::get();
        return view('backend.pages.category.edit',compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::whereId($id)->firstOrFail();

        if($request->hasFile('image')){
            dosyasil($category->image);

            $resim = $request->file('image');
            $dosyadi = time().'-'.Str::slug($request->name);
            $yukleKlasor = 'img/kategori/';
            $resimUrl = resimyukle($resim,$dosyadi,$yukleKlasor);
        }

        $category->update([
            'name' => $request->name,
            'image' => $resimUrl ?? $category->image,
            'cat_ust' => $request->cat_ust,
            'link' => $request->link,
            'status' => $request->status,
            'content' => $request->content,
        ]);
        return redirect()->route('panel.category.index')->withSuccess('Kategori Başarılı bir şekilde Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $category = Category::whereId($request->id)->firstOrFail();

        dosyasil($category->image);

        $category->delete();
        return response(['error'=> false,'message'=>'Kategori Başarılı bir şekilde Silindi']);


    }
    public function status(Request $request)
    {
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Category::whereId($request->id)->update(['status'=> $updatecheck]);
        return response(['error'=> false,'status'=>$update]);
    }
}

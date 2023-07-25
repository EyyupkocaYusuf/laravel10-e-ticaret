<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('backend.pages.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyadi = time().'-'.Str::slug($request->name);
            $yukleKlasor = 'img/slider/';

            $resimUrl = resimyukle($resim,$dosyadi,$yukleKlasor);
          }

        Slider::create([
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status,
            'content' => $request->content,
            'image' => $resimUrl ?? '',
          ]);
        return redirect()->route('panel.slider.index')->withSuccess('Slider Başarılı bir şekilde oluşturuldu');
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
        $slider = Slider::whereId($id)->first();
        return view('backend.pages.slider.edit',compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $slider = Slider::whereId($id)->firstOrFail();

        if($request->hasFile('image')){
            dosyasil($slider->image);

            $resim = $request->file('image');
            $dosyadi = time().'-'.Str::slug($request->name);
            $yukleKlasor = 'img/slider/';
            $resimUrl = resimyukle($resim,$dosyadi,$yukleKlasor);
        }

        $slider->update([
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status,
            'content' => $request->content,
            'image' => $resimUrl ?? $slider->image,
        ]);
        return redirect()->route('panel.slider.index')->withSuccess('Slider Başarılı bir şekilde Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $slider = Slider::whereId($request->id)->firstOrFail();

        dosyasil($slider->image);
        $slider->delete();
        return response(['error'=> false,'message'=>'Slider Başarılı bir şekilde Silindi']);


    }

    public function status(Request $request)
    {
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Slider::whereId($request->id)->update(['status'=> $updatecheck]);
        return response(['error'=> false,'status'=>$update]);
//        return response(['error'=> false,'status'=>$request->statu]);
    }

}

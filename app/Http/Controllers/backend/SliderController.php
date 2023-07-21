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
            $uzanti = $resim->getClientOriginalExtension();
           // $resim->move(public_path('img/slider'),$dosyadi.'.'.$uzanti);

            $yukleKlasor = 'img/slider/';


            if($uzanti == 'pdf' || $uzanti == 'svg' || $uzanti == 'webp' || $uzanti == 'jpeg') {
               $resim->move(public_path('img/slider'),$dosyadi.'.'.$uzanti);
                $resimUrl = $yukleKlasor.$dosyadi.'.'.$uzanti;
            }else {
                $resim = Image::make($resim);
                $yukleKlasor = 'img/slider/';
                $resim->encode('webp',75)->save($yukleKlasor.$dosyadi.'.webp');

                $resimUrl = $yukleKlasor.$dosyadi.'.webp';
            }
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
        if($request->hasFile('image')){
            $resim = $request->file('image');
            $dosyadi = time().'-'.Str::slug($request->name);
            $uzanti = $resim->getClientOriginalExtension();
            // $resim->move(public_path('img/slider'),$dosyadi.'.'.$uzanti);

            $yukleKlasor = 'img/slider/';

            if($uzanti == 'pdf' || $uzanti == 'svg' || $uzanti == 'webp') {
                $resim->move(public_path($yukleKlasor),$dosyadi.'.'.$uzanti);

                $resimUrl = $yukleKlasor.$dosyadi.'.'.$uzanti;
            }else {
                $resim = Image::make($resim);
                $resim->encode('webp',75)->save($yukleKlasor.$dosyadi.'.webp');

                $resimUrl = $yukleKlasor.$dosyadi.'.webp';
            }

        }

        Slider::where('id',$id)->update([
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status,
            'content' => $request->content,
            'image' => $resimUrl ?? null,
        ]);
        return back()->withSuccess('Slider Başarılı bir şekilde Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $slider = Slider::whereId($request->id)->firstOrFail();

        if(file_exists($slider->image))
        {
            if(!empty($slider->image)){
                unlink($slider->image);
            }
        }

        $slider->delete();
        return response(['error'=> false,'message'=>'Slider Başarılı bir şekilde Silindi']);


    }

    public function status(Request $request)
    {

//         if( $request->statu == "true")
//         {
//             dd("bjkl ");
//             $update = 1;
//         }else {
//             $update=0;
//         }
//         dd($update);
//        $slider = Slider::whereId($request->id)->first();
//        $slider->status = $request->statu == "true" ? "1": "0";
//        $slider->save();
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Slider::whereId($request->id)->update(['status'=> $updatecheck]);
        return response(['error'=> false,'status'=>$update]);
//        return response(['error'=> false,'status'=>$request->statu]);
    }

}

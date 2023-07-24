<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = SiteSetting::get();
        return view('backend.pages.setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $key = $request->name;
        SiteSetting::firstOrCreate([
            'name' => $key,
        ],[
            'name' => $key,
            'data' => $request->data,
            'set_type' => $request->set_type,
        ]);

        return redirect()->route('panel.setting.index')->withSuccess('Setting Başarılı bir şekilde Kaydedildi');
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
        $setting = SiteSetting::whereId($id)->firstOrFail();
        return view('backend.pages.setting.edit',compact('setting'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $setting = SiteSetting::whereId($id)->firstOrFail();
        $key = $request->name;

        if($request->hasFile('data')){
            dosyasil($setting->data);

            $resim = $request->file('data');
            $dosyadi = time().'-'.Str::slug($key);
            $yukleKlasor = 'img/setting/';
            $resimUrl = resimyukle($resim,$dosyadi,$yukleKlasor);
        }
        $setting->update([
            'name' => $key,
            'data' => $resimUrl ?? $request->data,
            'set_type' => $request->set_type,
        ]);

        return back()->withSuccess('Setting Başarılı bir şekilde Güncellendi');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $setting = SiteSetting::whereId($request->id)->firstOrFail();

        if($setting->set_type == 'image' || $setting->set_type == 'file')
        {
            dosyasil($setting->data);
        }
        $setting->delete();
        return response(['error'=> false,'message'=>'Setting Başarılı bir şekilde Silindi']);
    }
}

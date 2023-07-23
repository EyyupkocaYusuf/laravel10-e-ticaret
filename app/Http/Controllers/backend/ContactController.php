<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(15);
        return view('backend.pages.contact.index',compact('contacts'));
    }

    public function edit($id)
    {
        $contact = Contact::whereId($id)->firstOrFail();
        return view('backend.pages.contact.edit',compact('contact'));
    }

    public function update(Request $request,$id)
    {

        Contact::whereId($id)->update(['status'=> $request->status]);

        return redirect()->route('panel.contact.index')->withSuccess('Content alanı başarılı bir şekilde güncellendi.');
    }

    public function destroy(Request $request)
    {
        $category = Contact::whereId($request->id)->firstOrFail();

        $category->delete();
        return response(['error'=> false,'message'=>'Kategori Başarılı bir şekilde Silindi']);


    }
    public function status(Request $request)
    {
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Contact::whereId($request->id)->update(['status'=> $updatecheck]);
        return response(['error'=> false,'status'=>$update]);
    }
}

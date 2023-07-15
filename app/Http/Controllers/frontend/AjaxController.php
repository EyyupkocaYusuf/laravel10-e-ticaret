<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContentFormRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AjaxController extends Controller
{
    public function contactPost(ContentFormRequest $request)
    {
      /*  $validator = Validator::make($request->all(), [

        ]);

        if ($validator->fails()) {
            return redirect()->route('iletisim')
                ->withErrors($validator)
                ->withInput();
        }*/
            $data = $request->all();
            $data['ip'] = request()->ip();

            $contact = Contact::create($data);

            return redirect()->route('iletisim')->with('success', 'Message sent!');
        }

}

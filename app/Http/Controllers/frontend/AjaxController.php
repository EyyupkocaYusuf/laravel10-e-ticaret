<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class AjaxController extends Controller
{
    public function contactPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25',
            'surname' => 'required|string|max:25',
            'email' => 'required|string|email|max:25',
            'subject' => 'required|string|max:90',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('iletisim')
                ->withErrors($validator)
                ->withInput();
        }
            $data = $request->all();
            $data['ip'] = request()->ip();

            $contact = Contact::create($data);

            return redirect()->route('iletisim')->with('success', 'Message sent!');
        }

}

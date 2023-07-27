<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Invoice::withCount('orders')->paginate(15);
        return view('backend.pages.order.index',compact('orders'));
    }

    public function edit($id)
    {
        $invoice = Invoice::whereId($id)->with('orders')->firstOrFail();
        return view('backend.pages.order.edit',compact('invoice'));
    }

    public function update(Request $request,$id)
    {

    }

    public function destroy(Request $request)
    {
        $order = Invoice::whereId($request->id)->firstOrFail();
        Order::where('order_no',$order->order_no)->delete();
        $order->delete();
        return response(['error'=> false,'message'=>'Sipariş başarılı bir şekilde silindi']);


    }
    public function status(Request $request)
    {
        $update = $request->statu;
        $updatecheck = $update == "false" ? '0' : '1';
        Invoice::whereId($request->id)->update(['status'=> $updatecheck]);
        return response(['error'=> false,'status'=>$update]);
    }
}

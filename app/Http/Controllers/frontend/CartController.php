<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItem = session('cart',[]);
        $totalPrice = 0;

        foreach ($cartItem as $cart)
        {
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        return view('frontend.pages.cart',compact('cartItem','totalPrice'));
    }

    public function add(Request $request)
    {
        $productID = $request->product_id;
        $qty = $request->qty;
        $size = $request->size;
        $urun = Product::find($productID);
        if(!$urun)
        {
            return back()->withErrors('Ürün Bulunamadı');
        }

        $cartItem = session('cart',[]);
        if(array_key_exists($productID,$cartItem))
        {
            $cartItem[$productID]['qty'] += $qty;
        } else {
            $cartItem[$productID] = [
              'name' => $urun->name,
              'image' => $urun->image,
              'price' => $urun->price,
              'qty' => $qty,
              'size' => $size,
            ];
        }
        session(['cart' => $cartItem]);
        return back()->withSuccess('Ürün Sepete Eklendi');
    }

    public function remove()
    {
    }
}

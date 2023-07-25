<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
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

        if(session()->get('coupon_code')) {
            $kupon = Coupon::where('name',session()->get('coupon_code'))->whereStatus('1')->first();
            $kuponprice = $kupon->price ?? 0;
            $kuponcode = $kupon->name ?? '';

            $newtotalPrice = $totalPrice - $kuponprice;
        }else {
            $newtotalPrice = $totalPrice;
        }

        session()->put('total_price',$newtotalPrice);
        return view('frontend.pages.cart',compact('cartItem'));
    }

    public function sepetform()
    {
        $cartItem = session('cart',[]);
        $totalPrice = 0;

        foreach ($cartItem as $cart)
        {
            $totalPrice += $cart['price'] * $cart['qty'];
        }

        if(session()->get('coupon_code')) {
            $kupon = Coupon::where('name',session()->get('coupon_code'))->whereStatus('1')->first();
            $kuponprice = $kupon->price ?? 0;
            $kuponcode = $kupon->name ?? '';

            $newtotalPrice = $totalPrice - $kuponprice;
        }else {
            $newtotalPrice = $totalPrice;
        }

        session()->put('total_price',$newtotalPrice);
        return view('frontend.pages.cartform',compact('cartItem'));
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
              'qty' => $qty ?? 1,
              'size' => $size,
            ];
        }
        session(['cart' => $cartItem]);
        return back()->withSuccess('Ürün Sepete Eklendi');
    }

    public function remove(Request $request)
    {
        $productID = $request->product_id;
        $cartItem = session('cart',[]);

        if(array_key_exists($productID,$cartItem))
        {
            unset($cartItem[$productID]);
        }
        session(['cart' => $cartItem]);

        return back()->withSuccess('Ürün Sepetten Kaldırıldı.');

    }

    public function couponcheck(Request $request) {
        $cartItem = session('cart',[]);
        $totalPrice = 0;

        foreach ($cartItem as $cart)
        {
             $totalPrice += $cart['price'] * $cart['qty'];
        }

        $kupon = Coupon::where('name',$request->coupon_name)->whereStatus('1')->first();

        if(empty($kupon)) {
            return back()->withError('Kupon Bulunamadı');
        }
         $kuponprice = $kupon->price ?? 0;
         $kuponcode = $kupon->name ?? '';

         $newtotalPrice = $totalPrice - $kuponprice;

        session()->put('total_price',$newtotalPrice);

        session()->put('coupon_code',$kuponcode);

        return back()->withSuccess('Kupon Uygulandı');
    }


// ...

    public function newqty(Request $request)
    {
        $productID = $request->product_id;
        $qty = $request->qty?? 1;
        $itemTotal = 0;

        $urun = Product::find($productID);
        if(!$urun) {
            return response()->json('Ürün Bulunamadı');
        }
        $cartItem = session('cart',[]);

        if(array_key_exists($productID,$cartItem))
        {
            $cartItem[$productID]['qty'] = $qty;
            if($qty == 0 || $qty < 0) {
                unset($cartItem[$productID]);
            }

            $itemTotal = $urun->price * $qty;
        }
        session(['cart' => $cartItem]);
        if($request->ajax()) {
            return response()->json(['itemTotal'=>$itemTotal,'message'=>'Sepet Güncellendi']);
        }

    }

}

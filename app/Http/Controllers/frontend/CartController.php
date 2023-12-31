<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItem = $this->sepetList();
        return view('frontend.pages.cart',compact('cartItem'));
    }

    function sepetList() {
        $cartItem = session()->get('cart') ?? [];
        $totalPrice = 0;
        foreach ($cartItem as $cart)
        {
            $kdv = $cart['kdv'] ?? 0;
            $kdvTutar = ($cart['price'] * $cart['qty']) * ($kdv/100);
            $toplamTutar = ($cart['price'] * $cart['qty']) + $kdvTutar;
            $totalPrice += $toplamTutar;
        }

        if(session()->get('coupon_code')) {
            $kupon = Coupon::where('name',session()->get('coupon_code'))->whereStatus('1')->first();
            $kuponprice = $kupon->price ?? 0;
            $newtotalPrice = $totalPrice - $kuponprice;
        }else {
            $newtotalPrice = $totalPrice;
        }

        if(count(session()->get('cart')) == 0 && $totalPrice != 0)
        {
            session()->forget('coupon_code');
        }

        session()->put('total_price',$newtotalPrice);
        return $cartItem;
    }

    public function sepetform()
    {
        $cartItem = $this->sepetList();

        return view('frontend.pages.cartform',compact('cartItem'));
    }

    public function add(Request $request)
    {
        $productID = sifreCoz($request->product_id);
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
              'kdv' => $urun->kdv,
              'size' => $size,
            ];
        }
        session(['cart' => $cartItem]);

        if($request->ajax()) {
            return response()->json(['sepetCount' => count(session()->get('cart')),'message' => 'Ürün sepete eklendi']);
        }
        return back()->withSuccess('Ürün Sepete Eklendi');
    }

    public function remove(Request $request)
    {
        $productID = sifreCoz($request->product_id);
        $cartItem = session('cart',[]);

        if(array_key_exists($productID,$cartItem))
        {
            unset($cartItem[$productID]);
        }
        session(['cart' => $cartItem]);

        if(count(session()->get('cart')) == 0)
        {
            session()->forget('coupon_code');
        }

        if($request->ajax()) {
            return response()->json(['sepetCount' => count(session()->get('cart')),'message' => 'Ürün sepetten çıkarıldı']);
        }

        return back()->withSuccess('Ürün Sepetten Kaldırıldı.');
    }

    public function couponcheck(Request $request) {

        $kupon = Coupon::where('name',$request->coupon_name)->whereStatus('1')->first();

        if(empty($kupon)) {
            return back()->withError('Kupon Bulunamadı');
        }
        $kuponcode = $kupon->name ?? '';
        session()->put('coupon_code',$kuponcode);

        $kuponprice = $kupon->price ?? 0;
        session()->put('coupon_price',$kuponprice);

        $this->sepetList();

        return back()->withSuccess('Kupon Uygulandı');
    }

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
            $kdvOraniitem = $urun->kdv ;
            $kdvtutaritem = ($urun->price * $qty) * ($kdvOraniitem/100);
            $itemTotal = $urun->price * $qty + $kdvtutaritem;
        }
        session(['cart' => $cartItem]);

         $this->sepetList();
        if($request->ajax()) {
            return response()->json(['itemTotal'=>$itemTotal,'totalPrice'=>session()->get('total_price'),'message'=>'Sepet Güncellendi']);
        }

    }

    function generateKod() {
        $randevukodu = GenerateOtp(7);
        if($this->barcodeKodExists($randevukodu)) {
            return $this->generateKod();
        }
        return $randevukodu;
    }

    function barcodeKodExists($randevukodu) {

        return Invoice::where('order_no',$randevukodu)->exists();
    }

    public function payformsave(Request $request) {

        $invoce = Invoice::create([
            'user_id' => auth()->user()->id ?? null,
            'order_no'=>$this->generateKod(),
            'name' =>$request->name,
            'surname' =>$request->surname,
            'email' =>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'country' =>$request->country,
            'city'=>$request->city,
            'district'=>$request->district,
            'zip_code' =>$request->zip_code,
            'order_note'=>$request->order_note,
        ]);

        $cart = session()->get('cart') ?? [];
        foreach ($cart as $key => $item){
            Order::create([
                'order_no'=>$invoce->order_no,
                'product_id'=>$key,
                'name'=>$item['name'],
                'price'=>$item['price'],
                'qty'=>$item['qty'],
                'kdv'=>$item['kdv'],
            ]);
        }
        session()->forget('cart');
        return redirect()->route('anasayfa');
    }

}

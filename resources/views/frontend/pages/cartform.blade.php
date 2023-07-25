@extends("frontend.layouts.layout")

@section("content")
    <div class="bg-light py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-12">
                    <div class="border p-4 rounded" role="alert">
                        Returning customer? <a href="#">Click here</a> to login
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">Billing Details</h2>
                    <div class="p-3 p-lg-5 border">
                        <div class="form-group">
                            <label for="c_country" class="text-black">Ülke<span class="text-danger">*</span></label>
                            <select id="c_country" name="country" class="form-control">
                                <option value="">Ülke Seçiniz</option>
                                <option value="Turkey" selected>Türkiye</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">Adınız<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_fname" name="name">
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">Soyadınız<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_lname" name="surname">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">Adres <span class="text-danger">*</span></label>
                                <textarea type="text" class="form-control" id="c_address" name="address" placeholder="Adres" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">Şehir<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_state_country" name="city">
                            </div>

                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">İlçe<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_state_country" name="district">
                            </div>

                            <div class="col-md-12">
                                <label for="c_postal_zip" class="text-black">Posta Kodu<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_postal_zip" name="zip_code">
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">Email Addresi <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="c_email_address" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">Telefon<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="c_phone" name="phone" placeholder="Phone Number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">Sipariş Notu</label>
                            <textarea name="order_note" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                            <div class="p-3 p-lg-5 border">

                                <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                                <div class="input-group w-75">
                                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">Your Order</h2>
                            <div class="p-3 p-lg-5 border">
                                <table class="table site-block-order-table mb-5">
                                    <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Top Up T-Shirt <strong class="mx-2">x</strong> 1</td>
                                        <td>$250.00</td>
                                    </tr>
                                    <tr>
                                        <td>Polo Shirt <strong class="mx-2">x</strong>   1</td>
                                        <td>$100.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                        <td class="text-black">$350.00</td>
                                    </tr>
                                    <tr>
                                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                        <td class="text-black font-weight-bold"><strong>$350.00</strong></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                                    <div class="collapse" id="collapsebank">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                                    <div class="collapse" id="collapsecheque">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border p-3 mb-5">
                                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                                    <div class="collapse" id="collapsepaypal">
                                        <div class="py-2">
                                            <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='thankyou.html'">Place Order</button>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>

@endsection
@section('customjs')
{{--    <script>--}}
{{--        $(document).on('click','.paymentButton',function(e) {--}}

{{--        });--}}

{{--        $(document).on('click','.decreaseBtn',function(e) {--}}
{{--            $('.orderItem').removeClass('selected');--}}
{{--            $(this).closest('.orderItem').addClass('selected');--}}
{{--            sepetUpdate();--}}
{{--        });--}}

{{--        function sepetUpdate() {--}}
{{--            var product_id = $('.selected').closest('.orderItem').attr('data-id');--}}
{{--            var qty = $('.selected').closest('.orderItem').find('.qtyItem').val();--}}
{{--            $.ajax({--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                },--}}
{{--                type:"POST",--}}
{{--                url:"{{route('sepet.newqty')}}",--}}
{{--                data:{--}}
{{--                    product_id:product_id,--}}
{{--                    qty:qty,--}}
{{--                },--}}
{{--                success: function (response){--}}
{{--                    $('.selected').find('.itemTotal').text(response.itemTotal);--}}

{{--                    if(qty == 0) {--}}
{{--                        $('.selected').remove();--}}
{{--                    }--}}
{{--                    console.log(response);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--        $(document).on('click','.increaseBtn',function(e) {--}}
{{--            $('.orderItem').removeClass('selected');--}}
{{--            $(this).closest('.orderItem').addClass('selected');--}}
{{--            sepetUpdate();--}}
{{--        });--}}
{{--        </script>--}}
@endsection

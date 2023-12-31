@extends("frontend.layouts.layout")

@section("content")

    @include('frontend.inc.breadcrumb')

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <img src="{{asset($product->image)}}" alt="Image" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h2 class="text-black">{{$product->name ?? ''}}</h2>
                    <p>{!! $product->content ?? '' !!}</p>
                    <p><strong class="text-primary h4">{{number_format($product->price,2)}} ₺</strong></p>

                 <form id="addForm" method="POST">
                        @csrf
                     <input type="hidden" name="product_id" value="{{sifrele($product->id)}}">
                    <div class="mb-1 d-flex">
                        <label for="option-xs" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-xs" value="XS" {{$product->size == 'XS' ? 'checked' : ''}} name="size"></span> <span class="d-inline-block text-black">XS</span>
                        </label>
                        <label for="option-s" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-s" value="S" {{$product->size == 'S' ? 'checked' : ''}} name="size"></span> <span class="d-inline-block text-black">S</span>
                        </label>
                        <label for="option-m" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-m" value="M" {{$product->size == 'M' ? 'checked' : ''}} name="size"></span> <span class="d-inline-block text-black">M</span>
                        </label>
                        <label for="option-l" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-l" value="L" {{$product->size == 'L' ? 'checked' : ''}} name="size"></span> <span class="d-inline-block text-black">L</span>
                        </label>
                        <label for="option-xl" class="d-flex mr-3 mb-3">
                            <span class="d-inline-block mr-2" style="top:-2px; position: relative;"><input type="radio" id="option-xl" value="XL" {{$product->size == 'XL' ? 'checked' : ''}} name="size"></span> <span class="d-inline-block text-black">XL</span>
                        </label>
                    </div>
                    <div class="mb-5">
                        <div class="input-group mb-3" style="max-width: 120px;">
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center" value="1" name="qty" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                        </div>
                    </div>
                    <p><button type="submit" class="buy-now btn btn-sm btn-primary">Sepete Ekle</button></p>
                 </form>
                </div>
            </div>
        </div>
    </div>
    @if(!empty($products) && $products->count() > 0)
    <div class="site-section block-3 site-blocks-2 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 site-section-heading text-center pt-4">
                    <h2>Featured Products</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="nonloop-block-3 owl-carousel">
                            @foreach($products as $pr)
                                <div class="item">
                                    <div class="block-4 text-center">
                                        <figure class="block-4-image">
                                            <img src="{{asset($pr->image)}}" alt="{{$pr->name}}" class="img-fluid">
                                        </figure>
                                        <div class="block-4-text p-4">
                                            <h3><a href="{{route('urundetay',$pr->slug)}}">{{$pr->name}}</a></h3>
                                            <p class="mb-0">Finding perfect t-shirt</p>
                                            <p class="text-primary font-weight-bold">{{$pr->price}}</p>
                                        </div>
                                     </div>
                                </div>
                            @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@section('customjs')
    {{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}

    <script>
        $(document).on('submit','#addForm', function (e){
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"POST",
                url:"{{route('sepet.add')}}",
                data:formData,
                success: function (response) {
                    toastr.success(response.message);
                    $('.count').text(response.sepetCount);
                }
            });

        });

    </script>
@endsection


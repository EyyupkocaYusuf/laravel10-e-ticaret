@extends('backend.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Product Table</h4>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <p class="card-description">
                        <a href="{{route('panel.product.create')}}" class="btn btn-primary">Yeni</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Adı</th>
                                <th>Fiyat</th>
                                <th>Kategori</th>
                                <th>Kısa Metin</th>
                                <th>Renk</th>
                                <th>Beden</th>
                                <th>Adet</th>
                                <th>Status</th>
                                <th>Açıklama</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($products) && $products->count() > 0)
                                @foreach($products as $product)
                                    <tr class="item" item-id="{{ $product->id }}">
                                        <td class="py-1">
                                            <img src="{{asset($product->image)}}" alt="image"/>
                                        </td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->category_relation->name ?? ''}}</td>
                                        <td>{{$product->short_text}}</td>
                                        <td>{{$product->color}}</td>
                                        <td>{{$product->size}}</td>
                                        <td>{{$product->qty}}</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" {{$product->status == 1 ? 'checked' : ''}} data-toggle="toggle">
                                                </label>
                                            </div>

                                        </td>
                                        <td>{{\Illuminate\Support\Str::limit($product->content,25)}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.product.edit',$product->id)}}" class="btn btn-primary mr-2">Düzenle</a>
                                            <button type="button" class=" silBtn btn btn-danger">Sil</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')

<script>
    $(document).on('change', '.durum', function(e) {
        id = $(this).closest('.item').attr('item-id');
        statu = $(this).prop('checked');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"{{route('panel.category.status')}}",
            data:{
                id:id,
                statu:statu
            },
            success: function (response){
                console.log(response);
                if(response.status == "true")
                {
                    alertify.success("Durum Aktif Edildi");
                }else
                {
                    alertify.error("Durum Pasif Edildi");
                }
            }
        });
    });

    $(document).on('click', '.silBtn', function(e) {
            e.preventDefault();
        var item = $(this).closest('.item');
        id = item.attr('item-id');

        alertify.confirm("Silmek istediğinize emin misiniz?","Silmek istediğinize emin misiniz?",
            function(){
                            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:"DELETE",
                    url:"{{route('panel.product.destroy')}}",
                    data:{
                        id:id,
                    },
                    success: function (response){
                        console.log(response);
                        if(response.error == false)
                        {
                            item.remove();
                            alertify.success(response.message);
                        }else{
                            alertify.error("Bir hata oluştu");
                        }
                    }
                });

            },
            function(){
                alertify.error('Silme işlemi iptal edildi.');
            });
    });
</script>
@endsection

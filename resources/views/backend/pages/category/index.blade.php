@extends('backend.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category Table</h4>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <p class="card-description">
                        <a href="{{route('panel.category.create')}}" class="btn btn-primary">Yeni</a>
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Resim</th>
                                <th>Başlık</th>
                                <th>Slogan</th>
                                <th>link</th>
                                <th>Status</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($categories) && $categories->count() > 0)
                                @foreach($categories as $category)
                                    <tr class="item" item-id="{{ $category->id }}">
                                        <td class="py-1">
                                            <img src="{{asset($category->image)}}" alt="image"/>
                                        </td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->category->name ?? ''}}</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" {{$category->status == 1 ? 'checked' : ''}} data-toggle="toggle">
                                                </label>
                                            </div>

                                        </td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.category.edit',$category->id)}}" class="btn btn-primary mr-2">Düzenle</a>
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
                    url:"{{route('panel.category.destroy')}}",
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

@extends('backend.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Slider Table</h4>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Ad</th>
                                <th>Soyad</th>
                                <th>Email</th>
                                <th>Konu</th>
                                <th>Mesaj</th>
                                <th>Durum</th>
                                <th>İp</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!empty($contacts) && $contacts->count() > 0)
                                @foreach($contacts as $contact)
                                    <tr class="item" item-id="{{ $contact->id }}">
                                        <td>{{$contact->name}}</td>
                                        <td>{{$contact->surname}}</td>
                                        <td>{{$contact->email ?? ''}}</td>
                                        <td>{{$contact->subject}}</td>
                                        <td>{{\Illuminate\Support\Str::limit($contact->message,30)}}</td>
                                        <td>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" {{$contact->status == 1 ? 'checked' : ''}} data-toggle="toggle">
                                                </label>
                                            </div>

                                        </td>
                                        <td>{{$contact->ip}}</td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.contact.edit',$contact->id)}}" class="btn btn-primary mr-2">Düzenle</a>
                                            <button type="button" class=" silBtn btn btn-danger">Sil</button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        {{$contacts->links('pagination::bootstrap-4')}}
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
            url:"{{route('panel.contact.status')}}",
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
                    url:"{{route('panel.contact.destroy')}}",
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

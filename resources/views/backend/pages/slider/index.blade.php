@extends('backend.layouts.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Basic Table</h4>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif
                    <p class="card-description">
                        <a href="{{route('panel.slider.create')}}" class="btn btn-primary">Yeni</a>
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
                            @if(!empty($sliders) && $sliders->count() > 0)
                                @foreach($sliders as $slider)
                                    <tr>
                                        <td class="py-1">
                                            <img src="{{asset($slider->image)}}" alt="image"/>
                                        </td>
                                        <td>{{$slider->name}}</td>
                                        <td>{{$slider->content ?? ''}}</td>
                                        <td>{{$slider->link}}</td>
                                        <td>
                                            <div class="checkbox" item-id="{{ $slider->id }}">
                                                <label>
                                                    <input type="checkbox" class="durum" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger" {{$slider->stats == 1 ? 'checked' : ''}} data-toggle="toggle">
                                                </label>
                                            </div>

                                        </td>
                                        <td class="d-flex">
                                            <a href="{{route('panel.slider.edit',$slider->id)}}" class="btn btn-primary mr-2">Düzenle</a>
                                            <form action="{{route('panel.slider.destroy',$slider->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Sil</button>
                                            </form>
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
    {{--$(document).on('change', '.durum', async function(e) {--}}
    {{--    const checkbox = $(this).closest('.checkbox');--}}
    {{--    const id = checkbox.attr('item-id');--}}
    {{--    const statu = $(this).prop('checked');--}}

    {{--    // Önceki ajax isteği tamamlanmadan yeni bir istek başlatmayı önlemek için--}}
    {{--    if (checkbox.data('requestRunning')) {--}}
    {{--        return;--}}
    {{--    }--}}
    {{--    checkbox.data('requestRunning', true);--}}

    {{--    try {--}}
    {{--        const response = await $.ajax({--}}
    {{--            headers: {--}}
    {{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
    {{--            },--}}
    {{--            type: "POST",--}}
    {{--            url: "{{route('panel.slider.status')}}",--}}
    {{--            data: {--}}
    {{--                id: id,--}}
    {{--                statu: statu--}}
    {{--            }--}}
    {{--        });--}}

    {{--        if (response) {--}}
    {{--            alertify.success("Durum Aktif Edildi");--}}
    {{--        } else {--}}
    {{--            alertify.error("Durum Pasif Edildi");--}}
    {{--        }--}}
    {{--    } catch (error) {--}}
    {{--        alertify.error("İşlem sırasında bir hata oluştu.");--}}
    {{--        console.error(error);--}}
    {{--    } finally {--}}
    {{--        checkbox.data('requestRunning', false);--}}
    {{--    }--}}
    {{--});--}}


    $(document).on('change', '.durum', function(e) {
        id = $(this).closest('.checkbox').attr('item-id');
        statu = $(this).prop('checked');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type:"POST",
            url:"{{route('panel.slider.status')}}",
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
</script>
@endsection

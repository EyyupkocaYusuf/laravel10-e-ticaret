@extends('backend.layouts.layout')
@section('customcss')
    <style>
        .ck-content {
            height: 300px !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Setting Düzenle</h4>
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{session('success')}}
                        </div>
                    @endif

                    <form class="forms-sample" action="{{route('panel.setting.update',$setting->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                @if(isset($setting->set_type) && $setting->set_type == 'image')
                                    <img src="{{asset($setting->data ?? 'img/resimyok.webp')}}" alt="" width="250px" >
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <select name="set_type" class="form-control" id="setTypeSelect">
                                <option value="">Tür Seçiniz</option>
                                <option  value="ckeditor" {{isset($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : ''}}>CkEditor</option>
                                <option  value="textarea" {{isset($setting->set_type) && $setting->set_type == 'textarea' ? 'selected' : ''}}>Textarea</option>
                                <option  value="file" {{isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''}}>File</option>
                                <option  value="image" {{isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : ''}}>Image</option>
                                <option  value="text" {{isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : ''}}>Text</option>
                                <option  value="email" {{isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : ''}}>Email</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Key</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$setting->name}}" placeholder="name">
                        </div>

                        <div class="form-group">
                            <label for="data">Value</label>
                             <div class="inputContent">
                            @if(isset($setting->set_type) && $setting->set_type == 'ckeditor')
                                <textarea class="form-control" id="editor" name="data" placeholder="Data" rows="4">{!! $setting->data ?? '' !!}</textarea>
                            @elseif( isset($setting->set_type) && $setting->set_type == 'textarea')
                                <textarea class="form-control" id="data" name="data" placeholder="Data" rows="4">{!! $setting->data ?? '' !!}</textarea>
                            @elseif( isset($setting->set_type) && $setting->set_type == 'image' || isset($setting->set_type) && $setting->set_type == 'file')
                                <input type="file" class="form-control" name="data">
                            @elseif( isset($setting->set_type) && $setting->set_type == 'text')
                                <input type="text" class="form-control" name="data" placeholder="Yazınız" value="{{$setting->data ?? ''}}">
                            @elseif( isset($setting->set_type) && $setting->set_type == 'email' )
                                <input type="email" class="form-control" value="{{$setting->data}}">
                            @else

                            @endif
                           </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customjs')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>

    <script>
        function ckeditor(){
            ClassicEditor
                .create( document.querySelector( '#editor' ) )
                .catch( error => {
                    console.error( error );
                } );
        }

        $(document).on('change', '#setTypeSelect', function(e) {
            selectType = $(this).val();
            createInput(selectType);
        });

        function createInput(type) {
            defaultText = "{!! $setting->data ?? '' !!}"
            if (type === 'text') {
                newInput = $('<input>').attr({
                    type : 'text',
                    name : 'data',
                    value : defaultText,
                    class : 'form-control',
                    placeholder : "Value giriniz"
                });
            }else if(type === 'email') {
                newInput = $('<input>').attr({
                    type : 'email',
                    name : 'data',
                    value : defaultText,
                    class : 'form-control',
                    placeholder : "Eposta giriniz"
                });
            }else if(type === 'file' || type === 'image') {
                newInput = $('<input>').attr({
                    type : 'file',
                    name : 'data',
                });
            } else if (type === 'ckeditor') {
                newInput = $('<textarea>').attr({
                    name: 'data',
                    class: 'form-control ck-editor editor',
                    value: defaultText,
                    id: 'editor',
                });
                newInput.val(defaultText);
            }else if (type === 'textarea') {
                newInput = $('<textarea>').attr({
                    name: 'data',
                    value: defaultText,
                    placeholder: 'Textarea',
                    class: 'form-control textInput',
                });
                newInput.val(defaultText);
            }
            $('.inputContent').empty().append(newInput);
            if(type === 'ckeditor') {
                ckeditor();
            }
        }
    </script>
@endsection

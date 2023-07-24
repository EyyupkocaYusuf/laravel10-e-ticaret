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
                    <h4 class="card-title">Setting Ekle</h4>
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
                    <form class="forms-sample" action="{{route('panel.setting.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <select class="form-control" name="set_type" id="setTypeSelect">
                                <option value="">Tür Seçiniz</option>
                                <option value="ckeditor" {{isset($setting->set_type) && $setting->set_type == 'ckeditor' ? 'selected' : ''}}>CkEditor</option>
                                <option value="textarea" {{isset($setting->set_type) && $setting->set_type == 'textarea' ? 'selected' : ''}}>Textarea</option>
                                <option value="file" {{isset($setting->set_type) && $setting->set_type == 'file' ? 'selected' : ''}}>File</option>
                                <option value="image" {{isset($setting->set_type) && $setting->set_type == 'image' ? 'selected' : ''}}>Image</option>
                                <option value="text" {{isset($setting->set_type) && $setting->set_type == 'text' ? 'selected' : ''}}>Text</option>
                                <option value="email" {{isset($setting->set_type) && $setting->set_type == 'email' ? 'selected' : ''}}>Email</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Key</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="data">Value</label>
                            <div class="inputContent">
                                @if ( isset($setting->set_type) && $setting->set_type == 'ckeditor')
                                    <textarea class="form-control" id="editor" name="data" placeholder="Data" rows="4">{!! $setting->data ?? '' !!}</textarea>
                                @elseif (isset($setting->set_type) && $setting->set_type == 'textarea')
                                    <textarea class="form-control" id="data" name="data" placeholder="Data" rows="4">{!! $setting->data ?? '' !!}</textarea>
                                @elseif (isset($setting->set_type) && $setting->set_type == 'image' || isset($setting->set_type) && $setting->set_type == 'file')
                                    <input type="file" class="form-control" name="data">
                                @elseif (isset($setting->set_type) && $setting->set_type == 'text')
                                    <input type="text" class="form-control" name="data" placeholder="Yazınız" value="{{$setting->data ?? ''}}">
                                @elseif (isset($setting->set_type) && $setting->set_type == 'email' )
                                    <input type="email" class="form-control" value="{{$setting->data}}">
                                @else

                                @endif
                            </div>
                        </div>

                        <!-- HTML -->
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="image">File Upload</label>--}}
                        {{--                            <input type="file" id="image" name="image"  class="form-control">--}}
                        {{--                            <button id="upload-btn" class="btn btn-primary">Upload</button>--}}
                        {{--                        </div>--}}

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
            }else if(type === 'ckeditor') {
                    newInput = $('<textarea>').attr({
                    name : 'data',
                    value : defaultText,
                    class : 'form-control ck-content editor',
                    id : 'editor',
                    placeholder : "CKEditor"
                });
            }else if(type === 'textarea') {
                    newInput = $('<textarea>').attr({
                    name : 'data',
                    value : defaultText,
                    class : 'form-control',
                    placeholder : "textarea"
                });
            }
            $('.inputContent').empty().append(newInput);
            if(type === 'ckeditor') {
                ckeditor();
            }
        }
    </script>
@endsection

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
                    <h4 class="card-title">Slider Düzenle</h4>
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
                    <form class="forms-sample" action="{{route('panel.about.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$about->title}}" placeholder="title">
                        </div>

                         <div class="form-group">
                           <div class="input-group col-xs-12">
                             <img src="{{asset($about->image ?? 'img/resimyok.webp')}}" alt="" width="250px" >
                             </div>
                         </div>

                          <div class="form-group">
                              <label for="image">File Upload</label>
                              <input type="file" id="image" name="image" value="{{$about->image}}" class="form-control">
                              <button id="upload-btn" class="btn btn-primary">Upload</button>
                          </div>

                        <div class="form-group">
                            <label for="editor">Content</label>
                            <textarea name="content" class="form-control" id="editor"  rows="3" placeholder="Sloganı Yazın">{!!$about->content!!}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="text_icon_1">text_icon_1</label>
                            <input type="text" class="form-control" id="text_icon_1" name="text_icon_1" value="{{$about->text_icon_1}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="text_1">text_1</label>
                            <input type="text" class="form-control" id="text_1" name="text_1" value="{{$about->text_1}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="text_1_content">text_1_content</label>
                            <input type="text" class="form-control" id="text_1_content" name="text_1_content" value="{{$about->text_1_content}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="text_icon_2">text_icon_2</label>
                            <input type="text" class="form-control" id="text_icon_2" name="text_icon_2" value="{{$about->text_icon_2}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="text_2">text_2</label>
                            <input type="text" class="form-control" id="text_2" name="text_2" value="{{$about->text_2}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="text_2_content">text_2_content</label>
                            <input type="text" class="form-control" id="text_2_content" name="text_2_content" value="{{$about->text_2_content}}" placeholder="Link">
                        </div>
                        <div class="form-group">
                            <label for="text_icon_3">text_icon_3</label>
                            <input type="text" class="form-control" id="text_icon_3" name="text_icon_3" value="{{$about->text_icon_3}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="text_3">text_3</label>
                            <input type="text" class="form-control" id="text_3" name="text_3" value="{{$about->text_3}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="text_3_content">text_3_content</label>
                            <input type="text" class="form-control" id="text_3_content" name="text_3_content" value="{{$about->text_3_content}}" placeholder="Link">
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
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>


@endsection

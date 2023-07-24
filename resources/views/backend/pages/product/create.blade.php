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
                    <h4 class="card-title">Product Ekle</h4>
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
                    <form class="forms-sample" action="{{route('panel.product.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select  id="" name="category_id" class="form-control">
                                <option value="">Kategori Seçiniz</option>
                                @if($categories)
                                    @foreach($categories as $alt)
                                        <option  value="{{$alt->id}}" {{isset($category) && $category->cat_ust == $alt->id ? 'selected' : ''}}>
                                            {{$alt->name}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="image">File Upload</label>
                            <input type="file" id="image" name="image" class="form-control">
                            <button id="upload-btn" class="btn btn-primary">Upload</button>
                        </div>

                        <div class="form-group">
                            <label for="short_text">Short Text</label>
                            <input type="text" class="form-control" id="short_text" name="short_text"  placeholder="short_text">
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price"  placeholder="price">
                        </div>

                        <div class="form-group">
                            <label for="qty">Adet</label>
                            <input type="text" class="form-control" id="qty" name="qty"  placeholder="Adet">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="0" >Pasif</option>
                                <option value="1" selected>Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="color">Color</label>
                            <select class="form-control" id="color" name="color">
                                <option value="" >Renk Seçiniz </option>
                                <option value="Beyaz" >Beyaz </option>
                                <option value="Siyah" >Siyah</option>
                                <option value="Mor" >Mor</option>
                                <option value="Kahverengi" >Kahverengi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="size">Size</label>
                            <select class="form-control" id="size" name="size">
                                <option value="" >Beden Seçiniz </option>
                                <option value="XS" >XS </option>
                                <option value="S" >S</option>
                                <option value="M" >M</option>
                                <option value="L" >L</option>
                                <option value="XL" >XL</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" id="editor" rows="3" placeholder="İçeriği Yazın"></textarea>
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

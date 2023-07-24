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
                    <h4 class="card-title">Product Düzenle</h4>
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
                    <form class="forms-sample" action="{{route('panel.product.update',$product->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}"  placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="name">Kategori</label>
                            <select  id="" name="category_id" class="form-control">
                                <option value="">Kategori Seçiniz</option>
                                @if($categories)
                                    @foreach($categories as $alt)
                                        <option  value="{{$alt->id}}" {{isset($product) && $product->category_id == $alt->id ? 'selected' : ''}}>
                                            {{$alt->name}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <!-- HTML -->
                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                <img src="{{asset($product->image ?? 'img/resimyok.webp')}}" alt="" width="250px" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">File Upload</label>
                            <input type="file" id="image" name="image" class="form-control">
                            <button id="upload-btn" class="btn btn-primary">Upload</button>
                        </div>

                        <div class="form-group">
                            <label for="short_text">Short Text</label>
                            <input type="text" class="form-control" id="short_text" name="short_text" value="{{$product->short_text}}"   placeholder="short_text">
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}"   placeholder="price">
                        </div>

                        <div class="form-group">
                            <label for="qty">Adet</label>
                            <input type="text" class="form-control" id="qty" name="qty"  value="{{$product->qty}}" placeholder="Adet">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $product->status ?? '1';
                            @endphp
                            <select class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : '' }} >Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : '' }} >Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="color">Color</label>
                            @php
                                $color = $product->color ?? '';
                            @endphp
                            <select class="form-control" id="color" name="color">
                                <option value="" {{$color == '' ? 'selected' : '' }}>Renk Seçiniz </option>
                                <option value="Beyaz" {{$color == 'Beyaz' ? 'selected' : '' }} >Beyaz </option>
                                <option value="Siyah" {{$color == 'Siyah' ? 'selected' : '' }} >Siyah</option>
                                <option value="Mor" {{$color == 'Mor' ? 'selected' : '' }} >Mor</option>
                                <option value="Kahverengi" {{$color == 'Kahverengi' ? 'selected' : '' }} >Kahverengi</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="size">Size</label>
                            @php
                                $size = $product->size ?? '';
                            @endphp
                            <select class="form-control" id="size" name="size" >
                                <option value=""  {{$size == '' ? 'selected' : '' }}>Beden Seçiniz </option>
                                <option value="XS" {{$size == 'XS' ? 'selected' : '' }} >XS </option>
                                <option value="S" {{$size == 'S' ? 'selected' : '' }} >S</option>
                                <option value="M" {{$size == 'M' ? 'selected' : '' }} >M</option>
                                <option value="L" {{$size == 'L' ? 'selected' : '' }} >L</option>
                                <option value="XL" {{$size == 'XL' ? 'selected' : '' }} >XL</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" id="editor" rows="4" placeholder="İçeriği Yazın">{{$product->content}}</textarea>
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

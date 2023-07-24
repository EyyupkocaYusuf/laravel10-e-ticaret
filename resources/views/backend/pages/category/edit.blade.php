@extends('backend.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category Düzenle</h4>
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
                    <form class="forms-sample" action="{{route('panel.category.update',$category->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$category->name}}" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="cat_ust">Alt Kategori</label>
                            <select  id="" name="cat_ust" class="form-control">
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

                        <!-- HTML -->
                        <div class="form-group">
                            <div class="input-group col-xs-12">
                                <img src="{{asset($category->image ?? 'img/resimyok.webp')}}" alt="" width="250px" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image">File Upload</label>
                            <input type="file" id="image" name="image" value="{{$category->image}}" class="form-control">
                            <button id="upload-btn" class="btn btn-primary">Upload</button>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $category->status ?? '1';
                            @endphp
                            <select class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : '' }}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : '' }} >Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" id="content" rows="4" placeholder="İçeriği Yazın">{{$category->content ?? ''}} </textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


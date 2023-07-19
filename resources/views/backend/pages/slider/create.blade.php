@extends('backend.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Slider Ekle</h4>
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
                    <form class="forms-sample" action="{{route('panel.slider.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name"  placeholder="Name">
                        </div>

                        <!-- HTML -->
                        <div class="form-group">
                            <label for="image">File Upload</label>
                            <input type="file" id="image" name="image"  class="form-control">
                            <button id="upload-btn" class="btn btn-primary">Upload</button>
                        </div>



                        <div class="form-group">
                            <label for="status">Status</label>

                            <select class="form-control" id="status" name="status">
                                <option value="0">Pasif</option>
                                <option value="1" selected >Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" name="link"  placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea name="content" class="form-control" id="content"  rows="4" placeholder="Sloganı Yazın"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


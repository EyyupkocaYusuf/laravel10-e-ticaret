@extends('backend.layouts.layout')
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">İletişim Düzenle</h4>
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
                    <form class="forms-sample" action="{{route('panel.contact.update',$contact->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$contact->name}}" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{$contact->surname}}" placeholder="surname">
                        </div>

                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$contact->email}}" placeholder="email">
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" value="{{$contact->subject}}" placeholder="subject">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $contact->status ?? '1';
                            @endphp
                            <select class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : '' }}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : '' }} >Aktif</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ip">Ip</label>
                            <input type="text" class="form-control" id="ip" name="ip" value="{{$contact->ip}}" placeholder="Link">
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" id="content"  rows="8" placeholder="Sloganı Yazın">{!!$contact->message!!}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


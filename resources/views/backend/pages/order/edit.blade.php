@extends('backend.layouts.layout')
@section('customcss')
   <style> body {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #fafafa;
    font-family: system-ui;
    }

    * {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    }

    .page {
    width: 210mm;
    min-height: 297mm;
    padding: 20mm;
    margin: 10mm auto;
    border: 1px #d3d3d3 solid;
    border-radius: 5px;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    @page {
    size: A4;
    margin: 0;
    }

    @media print {
    html,
    body {
    width: 210mm;
    height: 297mm;
    }

    .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: initial;
    page-break-after: always;
    }
    }

    .center {
    text-align: center;
    }

    h2 {
    font-size: 36px;
    font-weight: 500;
    }

    .header-img {
    width: 100px;
    height: 100px;
    }

    .invoice {
    display: flex;
    justify-content: space-between;
    }

    .invoice-header {
    font-size: 24px;
    }

    .font-size-14 {
    font-size: 14px;
    line-height: 4px;
    }

    .bold-text {
    font-weight: 800;
    }

    table.unstyledTable {
    width: 100%;
    }

    table {
    border-collapse: collapse;
    border-spacing: 0 5px;
    table-layout: fixed;
    }

    thead tr th {
    border-bottom: 2px solid #DCDCDC;
    font-weight: 800;
    }

    tbody tr {
    border-bottom: 1px solid #DCDCDC;
    text-align: end;
    }

    tbody tr td {
    padding: 8px;
    }

    .last-row{
    border: 0;
    }

    .footer {
    text-align: end;
    }

    .font-weight-400{
    font-weight: 400;
    }
   </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sipariş Düzenle</h4>
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
                    <form class="forms-sample" action="{{route('panel.order.update',$order->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$order->name}}" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <label for="surname">Surname</label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{$order->surname}}" placeholder="surname">
                        </div>

                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$order->email}}" placeholder="email">
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            @php
                                $status = $order->status ?? '1';
                            @endphp
                            <select class="form-control" id="status" name="status">
                                <option value="0" {{$status == '0' ? 'selected' : '' }}>Pasif</option>
                                <option value="1" {{$status == '1' ? 'selected' : '' }} >Aktif</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>
                </div>
                <div class="page">
                    <div class="subpage">
                        <div class="header center"><img class="header-img" src="http://static1.squarespace.com/static/60323ee1186dda02003d1ccb/t/6077e628e2ed7c0242e84dcf/1618470443292/small.+black+text-01.png?format=1500w" />
                            <h2 class="font-weight-400" >Entity</h2>
                        </div>

                        <div class="invoice">
                            <div class="invoce-from">
                                <p class="invoice-header">Invoice To</p>
                                <div class="font-size-14">
                                    <p>Brad</p>
                                    <p>123123123123</p>
                                </div>
                            </div>
                            <div class="font-size-14">
                                <p class="bold-text">Invoice date: 09/09/2021</p>
                                <p>Booking date: 09/09/2021</p>
                            </div>
                        </div>
                    </div>

                    <div class="content">
                        <h2 class="center font-weight-400">Invoice</h2>
                        <p class="font-size-14">Invoice reference: 123234</p>

                        <table class="unstyledTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Qty</th>
                                <th>Rate of VAT</th>
                                <th>Unit Price</th>
                                <th>Unit Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Test ticket number</td>
                                <td>1</td>
                                <td>20%</td>
                                <td>5.00</td>
                                <td>5.00</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td colspan="2" class="bold-text">Including transaction fee:</td>
                                <td>32</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="bold-text">Net total:</td>
                                <td>32</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="bold-text">Vat total:</td>
                                <td>32</td>
                            </tr>
                            <tr class="last-row">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td class="bold-text">total:</td>
                                <td>32</td>
                            </tr>
                            </tbody>
                            </tr>
                        </table>

                        <div class="footer"><h2 class="font-weight-400">VAT. not Test<h2/></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.dashboard')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaction Completed</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#beli">Transaksi Beli</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#jual">Transaksi Jual</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#transfer">Transaksi Transfer</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body overflow-auto">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div id="beli" class="container tab-pane active"><br>
                                <table class="table" id="table_data">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Informasi</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$buys->toArray())
                                        <tr>
                                            <td colspan="4" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                        @endif
                                        @foreach ($buys as $key => $buy)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$buy->barcode}}</td>
                                            <td>
                                                User yang membeli : {{$buy->user->phone ?? ''}} ({{$buy->user->name}})<br>
                                                Nominal : Rp. {{number_format($buy->nominal,2 )}}<br>
                                                Waktu Transaksi : {{$buy->created_at}}
                                            </td>
                                            <td>
                                                <div class="badge badge-success">Selesai</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="jual" class="container tab-pane fade"><br>
                                <table class="table" id="table_data">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Informasi</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$sells->toArray())
                                        <tr>
                                            <td colspan="4" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                        @endif
                                        @foreach ($sells as $key => $sell)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$sell->barcode}}</td>
                                            <td>
                                                User yang menjual : {{$sell->user->phone ?? ''}} ({{$sell->user->name}})<br>
                                                Nominal : Rp. {{number_format($sell->nominal,2)}}<br>
                                                Waktu Transaksi : {{$sell->created_at}}
                                            </td>
                                            <td>
                                                <div class="badge badge-success">Selesai</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="transfer" class="container tab-pane fade"><br>
                                <table class="table" id="table_data">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Kode Transaksi</th>
                                            <th scope="col">Informasi</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$transfers->toArray())
                                        <tr>
                                            <td colspan="4" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                        @endif
                                        @foreach ($transfers as $key => $transfer)
                                        <tr>
                                            <th scope="row">{{$key+1}}</th>
                                            <td>{{$buy->barcode}}</td>
                                            <td>
                                                Transfer dari : {{$transfer->user->phone ?? ''}} ({{$transfer->user->name}})<br>
                                                Transfer Untuk : {{$transfer->destinationNumber ?? ''}} ({{$transfer->userDestinationByNumber->name}})<br>
                                                Nominal : Rp. {{number_format($transfer->nominal,2)}}<br>
                                                Waktu Transaksi : {{$transfer->created_at}}
                                            </td>
                                            <td>
                                                <div class="badge badge-success">Selesai</div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @endsection

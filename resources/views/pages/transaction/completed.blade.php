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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Informasi</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$buys->toArray())
                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                        @endif
                                        @foreach ($buys as $key => $buy)
                                        @php
                                        $tipe;
                                        if ($buy->type == 1) {
                                        $tipe = 'Beli';
                                        }elseif ($buy->type == 2) {
                                        $tipe = 'Jual';
                                        }elseif ($buy->type == 3) {
                                        $tipe = 'Transfer';
                                        }
                                        @endphp
                                        <tr>
                                            <th scope="row" rowspan="5">{{$key+1}}</th>
                                            <td rowspan="5">{{$buy->nominal}}</td>
                                            <td>
                                                Tipe transaksi : {{$tipe}}
                                            </td>
                                            <td rowspan="5">
                                                <div class="badge badge-success">Selesai</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nominal : {{$buy->nominal}}
                                            </td>
                                        </tr>
                                        <td>
                                            Transfer dari : {{$buy->user->phone ?? ''}}
                                        </td>
                                        <tr>
                                            <td>
                                                Transfer Untuk : {{$buy->destinationNumber ?? ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Waktu Transaksi : {{$buy->created_at}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="jual" class="container tab-pane fade"><br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Informasi</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$sells->toArray())
                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                        @endif
                                        @foreach ($sells as $key => $sell)
                                        @php
                                        $tipe;
                                        if ($sell->type == 1) {
                                        $tipe = 'Beli';
                                        }elseif ($sell->type == 2) {
                                        $tipe = 'Jual';
                                        }elseif ($sell->type == 3) {
                                        $tipe = 'Transfer';
                                        }
                                        @endphp
                                        <tr>
                                            <th scope="row" rowspan="5">{{$key+1}}</th>
                                            <td rowspan="5">{{$sell->nominal}}</td>
                                            <td>
                                                Tipe transaksi : {{$tipe}}
                                            </td>
                                            <td rowspan="5">
                                                <div class="badge badge-success">Selesai</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nominal : {{$sell->nominal}}
                                            </td>
                                        </tr>
                                        <td>
                                            Transfer dari : {{$sell->user->phone ?? ''}}
                                        </td>
                                        <tr>
                                            <td>
                                                Transfer Untuk : {{$sell->destinationNumber ?? ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Waktu Transaksi : {{$sell->created_at}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div id="transfer" class="container tab-pane fade"><br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Informasi</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!$transfers->toArray())
                                        <tr>
                                            <td colspan="5" class="text-center">Data Tidak Ada</td>
                                        </tr>
                                        @endif
                                        @foreach ($transfers as $key => $transfer)
                                        @php
                                        $tipe;
                                        if ($transfer->type == 1) {
                                        $tipe = 'Beli';
                                        }elseif ($transfer->type == 2) {
                                        $tipe = 'Jual';
                                        }elseif ($transfer->type == 3) {
                                        $tipe = 'Transfer';
                                        }
                                        @endphp
                                        <tr>
                                            <th scope="row" rowspan="5">{{$key+1}}</th>
                                            <td rowspan="5">{{$transfer->nominal}}</td>
                                            <td>
                                                Tipe transaksi : {{$tipe}}
                                            </td>
                                            <td rowspan="5">
                                                <div class="badge badge-success">Selesai</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Nominal : {{$transfer->nominal}}
                                            </td>
                                        </tr>
                                        <td>
                                            Transfer dari : {{$transfer->user->phone ?? ''}}
                                        </td>
                                        <tr>
                                            <td>
                                                Transfer Untuk : {{$transfer->destinationNumber ?? ''}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Waktu Transaksi : {{$transfer->created_at}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer overflow-auto">
                        <div class="tab-content">
                            <div id="jual" class="container tab-pane active"><br>
                                {!!$buys->links()!!}
                            </div>
                            <div id="beli" class="container tab-pane fade"><br>
                                {!!$sells->links()!!}
                            </div>
                            <div id="transfer" class="container tab-pane fade"><br>
                                {!!$transfers->links()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

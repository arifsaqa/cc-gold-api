@extends('layouts.dashboard')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Transaction Price</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body overflow-auto">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Informasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$transactions->toArray())
                                <tr>
                                    <td colspan="5" class="text-center">Data Tidak Ada</td>
                                </tr>
                                @endif
                                @foreach ($transactions as $key => $transaction)
                                @php
                                $tipe;
                                if ($transaction->type == 1) {
                                $tipe = 'Beli';
                                }elseif ($transaction->type == 2) {
                                $tipe = 'Jual';
                                }elseif ($transaction->type == 3) {
                                $tipe = 'Transfer';
                                }
                                @endphp
                                <tr>
                                    <th scope="row" rowspan="5">{{$key+1}}</th>
                                    <td rowspan="5">{{$transaction->nominal}}</td>
                                    <td>
                                        Tipe transaksi : {{$tipe}}
                                    </td>
                                    <td rowspan="5">
                                        <div class="badge badge-warning">Pending</div>
                                    </td>
                                    <td rowspan="5">
                                        <form action="{{ route('confirmation.transaction', ['id'=>$transaction->id]) }}" method="POST">
                                            @method('POST')
                                            @csrf
                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Nominal : {{$transaction->nominal}}
                                    </td>
                                </tr>
                                <td>
                                    Transfer dari : {{$transaction->user->phone ?? ''}}
                                </td>
                                <tr>
                                    <td>
                                        Transfer Untuk : {{$transaction->destinationNumber ?? ''}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Waktu Transaksi : {{$transaction->created_at}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {!!$transactions->links()!!}
                    </div>
                </div>
            </div>
        </div>
        @endsection
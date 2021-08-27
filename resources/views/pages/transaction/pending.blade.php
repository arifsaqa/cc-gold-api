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
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tanggal Transaksi</th>
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
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$transaction->nominal}}</td>
                                <td>{{$transaction->created_at}}</td>
                                <td><div class="badge badge-warning">Pending</div></td>
                                <td>
                                    <form action="{{ route('confirmation.transaction', ['id'=>$transaction->id]) }}" method="POST">
                                        @method('POST')
                                        @csrf
                                        <button type="submit" class="btn btn-success">Konfirmasi</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                </div>
        </div>
    </div>
@endsection

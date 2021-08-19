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
                        @foreach ($transactions as $key => $transaction)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$transaction->nominal}}</td>
                                <td>{{$transaction->created_at}}</td>
                                <td><div class="badge badge-success">Sukses</div></td>
                            </tr>
                        @endforeach
                        </tbody>
                      </table>
                </div>
        </div>
    </div>
@endsection

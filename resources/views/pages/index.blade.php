@extends('layouts.dashboard')
<!-- Main Content -->
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Harga Beli</h4>
                        </div>
                        <div class="card-body">
                            Rp. {{number_format($buy_latest->price) ?? 0}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Harga Jual</h4>
                        </div>
                        <div class="card-body">
                            Rp. {{number_format($sell_latest->price) ?? 0}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Berhasil</h4>
                        </div>
                        <div class="card-body">
                            {{count($transaction_completed)}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Gagal</h4>
                        </div>
                        <div class="card-body">
                            {{count($transaction_failed)}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Pending</h4>
                        </div>
                        <div class="card-body">
                            {{count($transaction_pending)}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
    </div>
@endsection


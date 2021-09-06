@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Payments</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" id="addpaymentmethod">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Metode Pembayaran</span>
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($payment_methods as $key => $payment_method)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$payment_method->name}}</td>
                                <td><img src="{{$payment_method->logo}}" style="max-width: 100px"></td>
                                <td>
                                    <form action="{{ route('payment-method.destroy', ['payment_method'=>$payment_method->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Del</button>
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
@section('modal')
    <div class="modal fade" id="paymentmethod" tabindex="-1" role="dialog" aria-labelledby="paymentmethod" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-set-resiLabel">Tambah Metode Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('paymentMethod.create')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
            @csrf
            <div class="modal-body row">
                <div class="form-group col-md-12">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="form-group col-md-6">
                    <label for="">Gambar (resolusi 480x480)</label>
                    <input type="file" name="image" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        </div>
    </div>
@endsection
@section('script')
<script>
    $('#addpaymentmethod').on('click', () => {
        $('#paymentmethod').modal('show')
    });
</script>
@endsection

@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Buy Price</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" id="addprice">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Harga</span>
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tanggal Update Harga</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            @foreach ($buy_price as $key => $buy)
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$buy->price}}</td>
                            <td>{{$buy->created_at}}</td>
                            @endforeach
                          </tr>
                        </tbody>
                      </table>
                </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="price" tabindex="-1" role="dialog" aria-labelledby="price" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-set-resiLabel">Tambah Harga Beli</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('buycreate')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
            <input type="text" class="form-control" name="user_id" value="{{Auth::id()}}" hidden>
            <input type="text" class="form-control" name="inbox_origin" value="{{Auth::user()->name}}" hidden>
            @csrf
            <div class="modal-body row">
                <div class="form-group col-md-6">
                <label for="">Harga Terbaru</label>
                <input type="text" class="form-control" name="price">
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
    $('#addprice').on('click', () => {
        $('#price').modal('show')
    });
</script>
@endsection
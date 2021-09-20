@extends('layouts.dashboard')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sell Price</h1>
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
                    <div class="card-body overflow-auto">
                        <table class="table" id="table_data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Tanggal Update Harga</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$sell_price->toArray())
                                <tr>
                                    <td colspan="3" class="text-center">Data Tidak Ada</td>
                                </tr>
                                @endif
                                @foreach ($sell_price as $key => $sell)
                                <tr>

                                    <th scope="row">{{$key+1}}</th>
                                    <td>Rp. {{number_format($sell->price, 2)}}</td>
                                    <td>{{$sell->updated_at}}</td>
                                    <td>
                                        <form action="{{ route('sell.destroy', ['sell'=>$sell->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-warning" onclick="setIndex({{$sell->id}})"><i class="fas fa-edit"></i></button>
                                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
                    <form action="{{route('sellcreate')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
                        <input type="text" class="form-control" name="user_id" value="{{Auth::id()}}" hidden>
                        <input type="text" class="form-control" name="inbox_origin" value="{{Auth::user()->name}}" hidden>
                        @csrf
                        <div class="modal-body row">
                            <div class="form-group col-md-12">
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
        <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-set-resiLabel">Edit Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="" method="POST" id="form-edit-sell" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="modal-body row">
                        <div class="form-group col-md-12">
                            <label for="">Harga Terbaru</label>
                            <input type="text" class="form-control" name="price" id="price_edit">
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
            function setIndex(id) {
                // index = id;
                // console.log(index);
                var url = "{{route('sell.edit', ":id")}}";
                url = url.replace(":id", id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        console.log(data);
                        $('#modal_edit').modal('show')
                        $("#price_edit").val(data.data.price)
                        var formAction = "{{route('sell.update', ":id")}}";
                        formAction = formAction.replace(':id', id);
                        $("#form-edit-sell").attr("action", formAction);
                    },
                });
            };
        </script>
        @endsection

@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Promotions</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" id="addprice">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Promo</span>
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Diskon</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($promos as $key => $promo)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$promo->title}}</td>
                                <td>{{$promo->description}}</td>
                                <td>{{$promo->discount}}</td>
                                <td><img src="{{ asset('images/'. $promo->image) }}" style="max-width: 100px"></td>
                                <td>Actions</td>
                            </tr>
                        @endforeach
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
            <h5 class="modal-title" id="modal-set-resiLabel">Tambah Promo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('promo.create')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
            @csrf
            <div class="modal-body row">
                <div class="form-group col-md-12">
                    <label for="">Judul</label>
                    <input type="text" class="form-control" name="title">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Deskripsi</label>
                    <textarea name="description" class="form-control" placeholder="Isi deskripsi disini"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="">Diskon (dalam nominal)</label>
                    <input type="number" class="form-control" name="discount">
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
    $('#addprice').on('click', () => {
        $('#price').modal('show')
    });
</script>
@endsection

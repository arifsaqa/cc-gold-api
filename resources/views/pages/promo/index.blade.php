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
                        <button class="btn btn-primary" id="addpromo">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Promo</span>
                        </button>
                    </div>
                    <div class="card-body overflow-auto">
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
                                    @php
                                    if ($promo->type == 1) {
                                    $discount = $promo->discount . '%';
                                    }else {
                                    $discount = 'Rp. ' . number_format($promo->discount);
                                    }
                                    @endphp
                                    <td>{{$discount}}</td>
                                    <td><img src="{{$promo->image}}" style="max-width: 100px"></td>
                                    <td>
                                        <form action="{{ route('promo.destroy', ['promo'=>$promo->id]) }}" method="POST">
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
                    <div class="card-footer">
                        {!!$promos->links()!!}
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('modal')
        <div class="modal fade" id="promo" tabindex="-1" role="dialog" aria-labelledby="promo" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-set-resiLabel">Tambah Promo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('promo.add')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
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
                            <div class="form-group col-md-5">
                                <label for="">Diskon (dalam nominal)</label>
                                <input type="number" class="form-control" name="discount">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Type</label>
                                <select name="type" class="form-control">
                                    <option value="1" selected>%</option>
                                    <option value="2">Rp.</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
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
        <div class="modal fade" id="promo" tabindex="-1" role="dialog" aria-labelledby="promo" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-set-resiLabel">Tambah Promo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('promo.add')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
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
                            <div class="form-group col-md-5">
                                <label for="">Diskon (dalam nominal)</label>
                                <input type="number" class="form-control" name="discount">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">Type</label>
                                <select name="type" class="form-control">
                                    <option value="1" selected>%</option>
                                    <option value="2">Rp.</option>
                                </select>
                            </div>
                            <div class="form-group col-md-5">
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
            $('#addpromo').on('click', () => {
                $('#promo').modal('show')
            });
        </script>
        @endsection
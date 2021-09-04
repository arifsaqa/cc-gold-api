@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Policies</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" id="addpolicy">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Policy</span>
                        </button>
                    </div>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Policy</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach ($policies as $key => $policy)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td>{{$policy->policy}}</td>
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
    <div class="modal fade" id="policy" tabindex="-1" role="dialog" aria-labelledby="policy" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-set-resiLabel">Tambah policy</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('policy.create')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
            @csrf
            <div class="modal-body row">
                <div class="form-group col-md-12">
                    <label for="">Policy</label>
                    <textarea name="policy" id="policy" class="form-control"></textarea>
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
    $('#addpolicy').on('click', () => {
        $('#policy').modal('show')
    });
</script>
@endsection

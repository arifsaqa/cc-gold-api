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
                    <div class="card-body overflow-auto">
                        <table class="table" id="table_data">
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
                                    <td>
                                        <form action="{{ route('policy.destroy', ['policy'=>$policy->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-warning" onclick="setIndex({{$policy->id}})"><i class="fas fa-edit"></i></button>
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
        <div class="modal fade" id="policy" tabindex="-1" role="dialog" aria-labelledby="policy" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-set-resiLabel">Tambah policy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('policy.store')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
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
        <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modal-set-resiLabel">Edit Data</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="" method="POST" id="form-edit-policy" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="modal-body row">
                        <div class="form-group col-md-12">
                            <label for="">Policy</label>
                            <textarea name="policy" class="form-control" id="policy_edit"></textarea>
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
            function setIndex(id) {
                // index = id;
                // console.log(index);
                var url = "{{route('policy.edit', ":id")}}";
                url = url.replace(":id", id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        console.log(data);
                        $('#modal_edit').modal('show')
                        $("#policy_edit").val(data.data.policy)
                        var formAction = "{{route('policy.update', ":id")}}";
                        formAction = formAction.replace(':id', id);
                        $("#form-edit-policy").attr("action", formAction);
                    },
                });
            };
        </script>
        @endsection

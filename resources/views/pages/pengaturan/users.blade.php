@extends('layouts.dashboard')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Pengaturan User</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body overflow-auto">
                        <table class="table" id="table_data">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Nomor Telepon</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $key => $user)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-warning" onclick="setIndex({{$user->id}})"><i class="fas fa-edit"></i></button>
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
    </section>
</div>
@endsection
@section('modal')
<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-set-resiLabel">Edit Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="POST" id="form-edit-user" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="modal-header">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="modal-body row">
                <div class="form-group col-md-12">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" id="name_edit">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Email</label>
                    <input type="email" class="form-control" name="email" id="email_edit">
                </div>
                <div class="form-group col-md-12">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" id="password_edit">
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
        function setIndex(id) {
                // index = id;
                // console.log(index);
                var url = "{{route('user.edit', ":id")}}";
                url = url.replace(":id", id);
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        console.log(data);
                        $('#modal_edit').modal('show')
                        $("#name_edit").val(data.data.name)
                        $("#email_edit").val(data.data.email)
                        var formAction = "{{route('user.update', ":id")}}";
                        formAction = formAction.replace(':id', id);
                        $("#form-edit-user").attr("action", formAction);
                    },
                });
            };
    </script>
@endsection

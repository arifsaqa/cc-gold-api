@extends('layouts.dashboard')
@section('content')
    <div class="main-content">
        <section class="section">
        <div class="section-header">
            <h1>Faqs</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-primary" id="addfaq">
                            <i class="fas fa-plus"></i>
                            <span>Tambah Faq</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Question</th>
                                <th scope="col">Answer</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($faqs as $key => $faq)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$faq->question}}</td>
                                    <td>{{$faq->answer}}</td>
                                    <td>Actions</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {!!$faqs->links()!!}
                    </div>
                </div>
        </div>
    </div>
@endsection
@section('modal')
    <div class="modal fade" id="faq" tabindex="-1" role="dialog" aria-labelledby="faq" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="modal-set-resiLabel">Tambah Faq</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{route('faq.store')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
            @csrf
            <div class="modal-body row">
                <div class="form-group col-md-12">
                    <label for="">Question</label>
                    <textarea name="question" id="question" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label for="">Answer</label>
                    <textarea name="answer" id="answer" class="form-control"></textarea>
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
    $('#addfaq').on('click', () => {
        $('#faq').modal('show')
    });
</script>
@endsection

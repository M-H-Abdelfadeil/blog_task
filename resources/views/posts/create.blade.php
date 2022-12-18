@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header h5">  <a href="{{ route('posts.index') }}">Posts</a> / create </div>

                    <div class="card-body">

                        <form id="form-post-create" method="POST" action="{{ route('posts.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" id="title" >
                                <small class="invalid-feedback form-text msg-title"></small>
                            </div>
                            <div class="form-group">
                                <label for="author">Author</label>
                                <input type="text" name="author" class="form-control" id="author" >
                                <small class="invalid-feedback form-text msg-author"></small>
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control" id="content"></textarea>
                                <small class="invalid-feedback form-text msg-content"></small>
                            </div>
                            <div class="form-group">
                                <label for="image">image</label>
                                <input type="file" name="image" class="form-control" id="image" >
                                <small class="invalid-feedback form-text msg-image"></small>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('posts.inc.modal');
    @section('script')

       <script>
        @include('posts.inc.request-ajax');

        $(function(){
            $('#form-post-create').submit(function(e){
                e.preventDefault();
                var url = $(this).attr('action');
                var method = $(this).attr('method');
                var data = new FormData(this);
                sendRequest(url ,  method , data)
            })
        })
       </script>
    @endsection
@endsection

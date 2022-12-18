@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between">
        <div>
            Created at  : {{ $post->created_at }}
        </div>
        @auth
            @can('view', $post)
                <div>
                    <a class="btn btn-primary mr-4" href="{{ route('posts.edit' ,$post->id) }}">Edit</a>
                    <button data-url="{{ route('posts.destroy',$post->id) }}" data-type="destroy" data-message="Are you sure to move it to the trash ? " class="btn btn-danger btn-action">Delete</button>
                </div>
            @endcan
        @endauth
    </div>
    <hr>
    <div>Title : {{ $post->title }}</div>
    <div>Author : {{ $post->author }}</div>
    <hr>
    <div class="box-img">
        <img src="{{ $post->image }}">

    </div>
    <div class="text-center mt-3">
        {{ $post->content }}
    </div>
    <hr>
    
    @auth
        <div>
            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class="form-group">
                    <label for="content">Comment</label>
                    <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" id="content"></textarea>
                    @error('comment')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                   
                </div>
                <button type="submit" class="btn btn-primary">Comment</button>
            </form>
        </div> 
    @else
    <div class="alert alert-warning">
        To be able to comment, <a href="{{ route('login') }}">log in  </a>  
    </div>     
    @endauth
    <h1>Comments</h1>
</div>
@endsection
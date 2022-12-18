@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-primary mr-4" href="{{ route('posts.edit' ,$post->id) }}">Edit</a>
                <button data-url="{{ route('posts.destroy',$post->id) }}" data-type="destroy" data-message="Are you sure to move it to the trash ? " class="btn btn-danger btn-action">Delete</button>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>  <a href="{{ route('posts.index') }}">Posts</a> / {{ $post->title }}</div>

                        <div>Date :  {{ $post->created_at  }}</div>
                    </div>
                </div>

                <div class="card-body">

                    <div class="h3">Title : {{ $post->title }}</div>
                    <div class="h3">Author : {{ $post->author }}</div>
                    <div class="box-img">
                        <img src="{{ $post->image }}">
                    </div>
                    <div class="text-center mt-5"> {{ $post->content }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

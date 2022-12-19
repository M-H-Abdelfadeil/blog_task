@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    My Posts
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add new post <i class="fa fa-plus-circle"></i></a>
                        <a href="{{ route('posts.trashed') }}" class="btn btn-danger">Trashed <i class="fa fa-trash"></i></a>
                    </div>


                    <table class="table table-dark mt-5">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse ($posts as $post )
                            <tr>
                                <th scope="row">{{ $post->id }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td>
                                    <a href="{{ route('posts.show',$post->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <button data-url="{{ route('posts.destroy',$post->id) }}" data-type="destroy" data-message="Are you sure to move it to the trash ? " class="btn btn-danger btn-action ml-3"><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <th colspan="4">
                                    <div class="alert alert-warning">Notfound posts</div>
                                </th>
                            </tr>
                        @endforelse

                        </tbody>
                      </table>
                </div>
                <div class="mt-5">
                    {{ $posts->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

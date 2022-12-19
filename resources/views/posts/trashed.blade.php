@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <a href="{{ route('posts.index') }}">Posts</a> / Trashed
                </div>

                <div class="card-body">



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
                                    <button data-url="{{ route('posts.restore',$post->id) }}" data-type="restore" data-message="Are you sure to restore ? " class="btn btn-primary btn-action" title="Restore">Restore<i class="fa fa-minus"></i></button>
                                    <button data-url="{{ route('posts.forceDelete',$post->id) }}" data-type="force_destroy" data-message="Are you sure to delete it permanently ? " class="btn btn-danger btn-action" title="Force Delete">Force Delete<i class="fa fa-times"></i></button>
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

@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @forelse($posts as $post)
            <div class="col-4">
                <div>
                    <div class="card" style="width: 18rem;">
                        <img src="{{ $post->image }}" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">{{ $post->title }}</h5>
                          <h6 class="card-title">{{ $post->created_at }}</h6>
                          <a href="{{ route('blog.posts.show',$post->id) }}" class="btn btn-primary">Details <i class="fa fa-eye"></i></a>
                        </div>
                      </div>
                </div>
            </div>

            @empty
                <div class="alert alert-warning">Not Found Posts</div>
            @endforelse

        </div>
        <div class="mt-5">
            {{ $posts->links('pagination::bootstrap-4') }}
        </div>

    </div>

@endsection

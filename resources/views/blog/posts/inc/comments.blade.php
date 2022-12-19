<h1>Comments</h1>
<div class="border border-primary p-3 ">
    @foreach ($comments as $comment)
        <div class="border border-darg p-2 rounded mt-4">
            <h5>{{ $comment->user->name }}</h5>
            <p>{{ $comment->comment }}</p>
            <div class="d-flex justify-content-end">
                @auth
                    @can('view', $comment)
                        <button data-url="{{ route('comments.destroy', $comment->id) }}" data-type="destroy"
                            data-message="Are you sure to deleted ? " class="btn btn-danger btn-action">Delete</button>
                    @endcan
                @endauth
            </div>
        </div>
    @endforeach
</div>

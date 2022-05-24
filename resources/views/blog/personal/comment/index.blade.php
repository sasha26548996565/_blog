@extends('layouts.blog')

@section('content')

    @foreach ($comments as $comment)
        <div class="card mt-3">
            <div class="card-header">
                @if ($comment->isDeleted())
                    <form action="{{ route('blog.personal.comment.restore', $comment->id) }}" method="POST">
                        @csrf

                        <input type="submit" class="btn btn-warning" value="restore">
                    </form>
                @else
                    <h4><a href="{{ route('blog.personal.comment.edit', $comment->id) }}">edit comment</a></h4>

                    <form action="{{ route('blog.personal.comment.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="submit" class="btn btn-danger" value="delete">
                    </form>
                @endif
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $comment->user->email }}</h5>
                <p class="card-text">{{ $comment->text }}</p>
                <a href="{{ route('blog.post.show', $comment->post->id) }}" class="btn btn-outline-secondary">show post</a>
            </div>
        </div>
    @endforeach

    {{ $comments->links('vendor.pagination.bootstrap-5') }}
@endsection

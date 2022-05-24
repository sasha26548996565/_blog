@extends('layouts.blog')

@section('title', 'edit comment')

@section('content')
    <h1>edit comment</h1>

    <form action="{{ route('blog.personal.comment.update', $comment->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <input type="text" value="{{ $comment->text }}" required name="text" class="form-control">
        </div><br>

        <div class="form-group">
            <input type="submit" value="update comment" class="btn btn-success">
        </div>
    </form>
@endsection

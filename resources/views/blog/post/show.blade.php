@extends('layouts.blog')

@section('content')
    <div class="card mt-3">
        <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top" style="max-width: 700px;" alt="{{ $post->title }}">
        <div class="card-body">
            <h6>{{ $post->user->email }}</h6>
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ $post->text }}</p>

            <form action="{{ route('blog.post.like', $post->id) }}" method="POST">
                @csrf

                @if (auth()->user()->checkLike($post->id))
                    <input type="submit" class="btn btn-success" value="liked">
                @else
                    <input type="submit" class="btn btn-danger" value="like it">
                @endif
            </form>

        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">CATEGORY: {{ $post->category->title }}</li>
        </ul>
        <div class="card-body">
            tags:
            @foreach ($post->tags as $tag)
                <a href="#" class="card-link">{{ $tag->title }},</a>
            @endforeach
        </div>
    </div>

    <h2>Comments: {{ $post->comments->count() }}</h2>

    @auth
        <form action="{{ route('blog.comment.store', $post->id) }}" method="POST" class="d-flex" style="max-width: 500px; margin-bottom: 30px;">
            @csrf


            <input type="text" name="text" required placeholder="input text" class="form-control me-2">
            <input type="submit" class="btn btn-outline-secondary">

        </form>
    @endauth

    @guest
        вы не можете отправлять комментариий, нужно зарегестрироваться <a href="{{ route('register') }}">Регистрация</a>|
        <a href="{{ route('login') }}">авторизация</a>
    @endguest

    @foreach ($post->comments as $comment)
        <p>{{ $comment->user->email }}</p>
        <p>{{ $comment->text }}</p>
        <hr>
    @endforeach
@endsection

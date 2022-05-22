@extends('layouts.blog')

@section('content')
    <h1>personal</h1>

    <div class="card mt-3">
        <div class="card-header">
            Понравившиеся посты: {{ $data['countLikedPosts'] }}
        </div>

        <div class="card-body">
            <a href="{{ route('blog.personal.likedPosts.index') }}">show</a>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            Мои комментарии: {{ $data['countComments'] }}
        </div>

        <div class="card-body">
            <a href="{{ route('blog.personal.comment.index') }}">show</a>
        </div>
    </div>

@endsection

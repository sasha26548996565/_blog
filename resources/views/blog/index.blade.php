@extends('layouts.blog')

@section('content')
    <h1><a href="{{ route('blog.post.create') }}">добавить пост</a></h1>
    @foreach ($posts as $post)
        <div class="card mt-3">
            <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top" style="max-width: 700px;" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ Str::limit($post->text, 50) }}</p>
                <a href="{{ route('blog.post.show', $post->id) }}" class="btn btn-outline-secondary">show more</a>
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
    @endforeach

    {{ $posts->links('vendor.pagination.bootstrap-5') }}
@endsection

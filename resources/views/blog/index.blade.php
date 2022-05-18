@extends('layouts.blog')

@section('content')
    @foreach ($posts as $post)
        <div class="card mt-3">
            <img src="..." class="card-img-top" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ Str::limit($post->text, 50) }}</p>
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
@endsection
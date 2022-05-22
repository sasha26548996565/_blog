@extends('layouts.blog')

@section('content')
    <h1>Tag: {{ $tagName }}</h1>

    @foreach ($posts as $post)
        <div class="card mt-3">
            <img src="..." class="card-img-top" alt="{{ $post->title }}">
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ Str::limit($post->text, 50) }}</p>
                <a href="{{ route('blog.post.show', $post->id) }}" class="btn btn-outline-secondary">show more</a>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">CATEGORY: {{ $post->category->title }}</li>
            </ul>
        </div>
    @endforeach

    {{ $posts->links('vendor.pagination.bootstrap-5') }}
@endsection

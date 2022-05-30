@extends('layouts.admin')

@section('content')
    @auth
        <h1><a href="{{ route('admin.post.create') }}">добавить пост</a></h1>
    @endauth

    <h2>filters</h2>

    <form action="" method="GET">
        <div class="form-group">
            <input type="text" placeholder="search" name="search" value="{{ $_GET['search'] ?? "" }}" class="form-control" style="max-width: 350px;">
        </div>

        <div class="form-group">
            <select name="category_id" class="form-group">
                <option disabled selected class="form-control">choose category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(isset($_GET['category_id']) && $_GET['category_id'] == $category->id)
                        class="form-control">{{ $category->title }}</option>
                @endforeach
            </select>

            <select name="tags[]" id="" class="form-group" multiple>
                <option disabled class="form-control">choose tags</option>

                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"

                        @selected(isset($_GET['tags']) && is_array($_GET['tags']) && in_array($tag->id, $_GET['tags']))
                        >{{ $tag->title }}</option>
                @endforeach
            </select>

            <input type="submit" class="btn btn-success">
        </div>
    </form>

    @foreach ($posts as $post)
        <div class="card mt-3">
            <img src="{{ asset('storage/'. $post->image) }}" class="card-img-top" style="max-width: 700px;" alt="{{ $post->title }}">

            <div class="card-header">
                @can('update')
                    <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-warning">edit post</a>
                @endcan

                @can('delete')
                    @if ($post->isDeleted())
                        <form action="{{ route('admin.post.restore', $post->id) }}" method="POST">
                            @csrf

                            <input type="submit" class="btn btn-secondary" value="restore">
                        </form>
                    @else
                        <form action="{{ route('admin.post.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" value="delete">
                        </form>
                    @endif
                @endcan
            </div>

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

    {{ $posts->withQueryString()->links('vendor.pagination.bootstrap-5') }}
@endsection

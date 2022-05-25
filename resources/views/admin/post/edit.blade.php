@extends('layouts.admin')

@section('content')
    <h1>post update</h1>

    <form action="{{ route('admin.post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="title"
                value="{{ $post->title }}" required>

            @error('title')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <textarea name="text" class="form-control" placeholder="text">
                {{ $post->text }}</textarea>

            @error('text')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <select class="form-control" name="category_id">
                <option selected>choose category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected($category->id == $post->category->id)
                        >{{ $category->title }}</option>
                @endforeach
            </select>

            @error('category_id')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <select class="form-control" multiple name="tags[]">
                <option disabled>choose tags</option>

                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @selected(is_array($post->tags->pluck('id')->toArray()) &&
                            in_array($tag->id, $post->tags->pluck('id')->toArray()))

                        >{{ $tag->title }}</option>
                @endforeach
            </select>

            @error('tags')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="update post">
        </div>
    </form>
@endsection

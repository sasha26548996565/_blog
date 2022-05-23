@extends('layouts.blog')

@section('content')
    <h1>post create</h1>

    <form action="{{ route('blog.post.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="title" required>

            @error('title')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <textarea name="text" class="form-control" placeholder="text">{{ old('text') }}</textarea>

            @error('text')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <select class="form-control" name="category_id">
                <option selected>choose category</option>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>
                        {{ $category->title }}</option>
                @endforeach
            </select>

            @error('category_id')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <select class="form-control" multiple name="tags[]">
                <option selected>choose tags</option>

                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                        @selected(is_array(old('tags')) && in_array($tag->id, old('tags')))
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
            <input type="submit" class="btn btn-success" value="add post">
        </div>
    </form>
@endsection

@extends('layouts.admin')

@section('content')
    <h1><a href="{{ route('admin.user.create') }}">create user</a></h1>

    @foreach ($users as $user)
        <div class="card mt-3">

        {{-- <div class="card-header">
                @can('update-post')
                    <a href="{{ route('admin.post.edit', $post->id) }}" class="btn btn-warning">edit post</a>
                @endcan

                @can('delete-post')
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
            </div> --}}

            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>
            </div>
        </div>
    @endforeach
@endsection

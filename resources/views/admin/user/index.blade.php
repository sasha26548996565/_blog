@extends('layouts.admin')

@section('content')
    <h1><a href="{{ route('admin.user.create') }}">create user</a></h1>

    <h2>filters</h2>

    <form action="" method="GET">
        <div class="form-group">
            <input type="text" placeholder="search" name="search" value="{{ $_GET['search'] ?? "" }}" class="form-control" style="max-width: 350px;">
        </div>

        <div class="form-group">
            <select name="role" class="form-group">
                <option disabled selected class="form-control">choose role</option>

                @foreach ($roles as $role)
                    <option value="{{ $role->name }}"
                        @selected(isset($_GET['role']) && $_GET['role'] == $role->name)
                        class="form-control">{{ $role->name }}</option>
                @endforeach
            </select>

            <select name="permissions[]" id="" class="form-group" multiple>
                <option disabled class="form-control">choose permissions</option>

                @foreach ($permissions as $permission)
                    <option value="{{ $permission->name }}"

                        @selected(isset($_GET['permissions']) && is_array($_GET['permissions']) && in_array($permission->name,
                            $_GET['permissions']))
                        >{{ $permission->name }}</option>
                @endforeach
            </select>

            <input type="submit" class="btn btn-success">
        </div>
    </form>

    @foreach ($users as $user)
        <div class="card mt-3">

        <div class="card-header">

                @can('delete')
                    @if ($user->isDeleted())
                        <form action="{{ route('admin.user.restore', $user->id) }}" method="POST">
                            @csrf

                            <input type="submit" class="btn btn-secondary" value="restore">
                        </form>
                    @else
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <input type="submit" class="btn btn-danger" value="delete">
                        </form>
                    @endif
                @endcan
            </div>

            <div class="card-body">
                <h5 class="card-title">{{ $user->name }}</h5>
                <p class="card-text">{{ $user->email }}</p>
            </div>
        </div>
    @endforeach
@endsection

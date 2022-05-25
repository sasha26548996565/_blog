@extends('layouts.admin')

@section('content')
    <h1>user create</h1>

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="name" required>

            @error('name')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email" required>

            @error('email')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <select class="form-control" name="role">
                <option selected>choose role</option>

                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected($role->id == old('role'))>
                        {{ $role->name }}</option>
                @endforeach
            </select>

            @error('role_id')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <select class="form-control" multiple name="permissions[]">
                <option disabled>choose permissions</option>

                @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}"
                        @selected(is_array(old('permissions')) && in_array($permission->id, old('permissions')))
                        >{{ $permission->name }}</option>
                @endforeach
            </select>

            @error('permissions')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <input type="submit" class="btn btn-success" value="add user">
        </div>
    </form>
@endsection

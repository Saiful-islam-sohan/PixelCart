@extends('admin.layouts.master')

@section('title', 'Edit/Permission')

@section('admin.content')
<div class="container">
    <h2>Edit Permission</h2>

    <form action="{{ route('admin.permissions.update', $permission->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $permission->name) }}" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

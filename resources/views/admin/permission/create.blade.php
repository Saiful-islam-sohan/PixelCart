@extends('admin.layouts.master')

@section('admin.content')
<div class="container">
    <h2>Create Permission</h2>

    <form action="{{ route('admin.permissions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Permission Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

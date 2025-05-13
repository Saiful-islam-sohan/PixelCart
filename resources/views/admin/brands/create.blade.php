@extends('admin.layouts.master')

@section('title', 'Create Brand')

@section('admin.content')
<div class="container mt-4">
    <h2>Create Brand</h2>

    <form action="{{ route('admin.brand.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

       
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
        <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="status" name="status" value="1"
                    {{ old('status', $brand->status ?? true) ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
            </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('admin.brand.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

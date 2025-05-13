@extends('admin.layouts.master')

@section('title', isset($category) ? 'Edit Category' : 'Create Category')

@section('admin.content')
<div class="container mt-4">
    <h2>{{ isset($category) ? 'Edit' : 'Create' }} Category</h2>

    <form action="{{ isset($category) ? route('admin.category.update', $category->id) : route('admin.category.store') }}" 
          method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($category))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" id="name" class="form-control"
                   value="{{ old('name', $category->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image (optional)</label>
            <input type="file" name="image" id="image" class="form-control">
            @if (!empty($category->image))
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="100">
                </div>
            @endif
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (optional)</label>
            <textarea name="description" id="description" class="form-control">{{ old('description', $category->description ?? '') }}</textarea>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="status" name="status" value="1"
                   {{ old('status', $category->status ?? true) ? 'checked' : '' }}>
            <label class="form-check-label" for="status">Active</label>
        </div>

        <button class="btn btn-primary">{{ isset($category) ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection

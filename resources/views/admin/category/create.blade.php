@extends('admin.layouts.master')

@section('title', 'Create Category')

@section('admin.content')
    <div class="container mt-4">
        <h2>Create Category</h2>

        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                <input type="text" name="name" id="name" class="form-control" required
                    value="{{ old('name', $category->name ?? '') }}">
            </div>

          
            <div class="mb-3">
                <label for="image" class="form-label">Image (optional)</label>
                <input type="file" name="image" id="image" class="form-control">
               
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


            <button class="btn btn-primary">Save</button>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection

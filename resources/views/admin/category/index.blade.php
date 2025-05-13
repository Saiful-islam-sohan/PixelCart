@extends('admin.layouts.master')

@section('title', 'All Categories')

@section('admin.content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Categories</h2>
        <a href="{{ route('admin.category.create') }}" class="btn btn-primary">+ Add New Category</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Name</th>
                <th width="20%">Slug</th>
                <th width="15%">Image</th>
                <th>Description</th>
                <th width="10%">Status</th>
                <th width="15%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $key => $category)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" width="50" alt="Category Image" class="rounded-circle border border-primary shadow">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($category->description, 50) }}</td>
                    <td>
                        <span class="badge bg-{{ $category->status ? 'success' : 'danger' }}">
                            {{ $category->status ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>

                        <form action="{{ route('admin.category.delete', $category->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

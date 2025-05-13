@extends('admin.layouts.master')

@section('title', 'Brands')

@section('admin.content')
<div class="container mt-4">
    <h2>Brand List</h2>

    <a href="{{ route('admin.brand.create') }}" class="btn btn-primary mb-3">Create New Brand</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brands as $brand)
            <tr>
                <td>{{ $brand->name }}</td>
                <td>{{ $brand->slug }}</td>
                <td>{{ $brand->description }}</td>
                <td>
                    @if ($brand->image)
                        {{-- <img src="{{ asset('storage/' . $brand->image) }}" width="50" alt="Brand Image"> --}}
                        <img src="{{ asset($brand->image) }}" width="50" alt="Brand Image">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.brand.edit', $brand->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.brand.delete', $brand->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

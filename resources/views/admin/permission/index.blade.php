@extends('admin.layouts.master')

@section('admin.content')
<div class="container">
    <h2>Permissions</h2>
    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary mb-3">Add Permission</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>
                        <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        
                        <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
</div>
@endsection

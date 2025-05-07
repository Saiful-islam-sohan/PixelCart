@extends('admin.layouts.master')

@section('admin.content')
<div class="container">
    <h2>Roles and Permissions</h2>

    <a href="{{ route('admin.roles.create') }}" class="btn btn-success mb-3">Create New Role</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Role Name</th>
                <th>Permissions</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ ucfirst($role->name) }}</td>
                    <td>
                        @foreach($role->permissions as $permission)
                            <span class="badge bg-primary">{{ ucfirst($permission->name) }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" class="d-inline">
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

@extends('admin.layouts.master')

@section('title', 'User List')

@section('admin.content')
<div class="container-fluid">


    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>User List</h2>
        <a href="{{ route('admin.user.create') }}" class="btn btn-success">+ Create User</a>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge bg-info">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('admin.user.edit',$user->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

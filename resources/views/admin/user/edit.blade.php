@extends('admin.layouts.master')

@section('title', 'Edit User')

@section('admin.content')
<div class="container-fluid">
    <h2>Edit User</h2>

    <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <small>(leave blank to keep current)</small></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Assign Roles with Extra Info</label>
            <div id="role-list" class="d-flex flex-column gap-2">
                @foreach ($roles as $role)
                    @php
                        $hasRole = $user->roles->contains('id', $role->id);
                        $note = old("role_notes.$role->id", $user->role_notes[$role->id] ?? '');
                    @endphp
                    <div class="d-flex align-items-center role-item" data-role-id="{{ $role->id }}">
                        <input type="checkbox" class="form-check-input me-2 role-checkbox"
                            id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                            {{ $hasRole ? 'checked' : '' }}>
                        <label for="role-{{ $role->id }}" class="me-3 mb-0">{{ ucfirst($role->name) }}</label>
                        <input type="text" name="role_notes[{{ $role->id }}]"
                            class="form-control role-note-input {{ $hasRole ? '' : 'd-none' }}"
                            placeholder="Optional note..." value="{{ $note }}">
                    </div>
                @endforeach
            </div>
        </div>

        <button class="btn btn-primary">Update User</button>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.role-checkbox').forEach(cb => {
        cb.addEventListener('change', function () {
            const roleItem = this.closest('.role-item');
            const input = roleItem.querySelector('.role-note-input');
            if (this.checked) {
                input.classList.remove('d-none');
                input.focus();
            } else {
                input.classList.add('d-none');
                input.value = '';
            }
        });
    });
</script>
@endpush
@endsection

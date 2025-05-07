@extends('admin.layouts.master')

@section('title', 'Create User')

@section('admin.content')
<div class="container-fluid">
    <h2>Create New User</h2>

    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Assign Roles with Extra Info</label>
            <div id="role-list" class="d-flex flex-column gap-2">
                @foreach ($roles as $role)
                    <div class="d-flex align-items-center role-item" data-role-id="{{ $role->id }}">
                        <input type="checkbox" class="form-check-input me-2 role-checkbox" id="role-{{ $role->id }}" name="roles[]" value="{{ $role->id }}">
                        <label for="role-{{ $role->id }}" class="me-3 mb-0">{{ ucfirst($role->name) }}</label>
                        <input type="text" name="role_notes[{{ $role->id }}]" class="form-control d-none role-note-input" placeholder="Optional note...">
                    </div>
                @endforeach
            </div>
        </div>
        
        
        

        <button class="btn btn-primary">Create User</button>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

@push('styles')
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
        min-height: calc(1.5em + 0.75rem + 2px);
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }
</style>
@endpush

@push('scripts')
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select roles",
            allowClear: true,
            width: '100%'
        });
    });
</script>


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
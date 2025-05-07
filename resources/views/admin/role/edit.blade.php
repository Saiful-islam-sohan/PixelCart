@extends('admin.layouts.master')

@section('title', 'Edit Role')

@section('admin.content')
<div class="container-fluid">
    <h2>Edit Role: {{ ucfirst($role->name) }}</h2>

    <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Role Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $role->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row">
            <!-- Left: Group List -->
            <div class="col-md-3 border-end">
                <ul class="list-group" id="groupList">
                    @foreach($groupedPermissions as $group => $permissions)
                        <li class="list-group-item group-item" data-group="{{ $group }}" style="cursor: pointer;">
                            <input type="checkbox" class="form-check-input me-2 group-toggle" data-group="{{ $group }}"
                                {{ $role->permissions->pluck('name')->contains($group) ? 'checked' : '' }}>
                            {{ ucfirst($group) }}
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Right: Permissions -->
            <div class="col-md-9">
                @foreach($groupedPermissions as $group => $permissions)
                    <div class="permission-group mb-3" data-group="{{ $group }}">
                        <h5>{{ ucfirst($group) }} Permissions</h5>
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input permission-checkbox {{ $group }}-permission"
                                               type="checkbox"
                                               name="permissions[]"
                                               value="{{ $permission->id }}"
                                               id="perm-{{ $permission->id }}"
                                               @if($role->permissions->contains($permission)) checked @endif>
                                        <label class="form-check-label" for="perm-{{ $permission->id }}">
                                            {{ ucfirst($permission->name) }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                    </div>
                @endforeach
            </div>
        </div>

        <button class="btn btn-primary mt-3">Update Role</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary mt-3">Back</a>
    </form>
</div>
@endsection

@section('admin.script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // When group name is clicked or checkbox is changed
        document.querySelectorAll('.group-item').forEach(item => {
            item.addEventListener('click', function (e) {
                if (e.target.tagName !== 'INPUT') {
                    let group = item.dataset.group;
                    let checkbox = item.querySelector('.group-toggle');
                    checkbox.checked = !checkbox.checked;
                }

                let group = item.dataset.group;
                let isChecked = item.querySelector('.group-toggle').checked;

                // Sync individual permission checkboxes with the group checkbox
                document.querySelectorAll(`.${group}-permission`).forEach(cb => {
                    cb.checked = isChecked;
                });
            });
        });

        // Sync group checkbox with individual permission checkboxes
        document.querySelectorAll('.permission-checkbox').forEach(cb => {
            cb.addEventListener('change', function () {
                let classList = cb.classList;
                let group = Array.from(classList).find(c => c.endsWith('-permission')).replace('-permission', '');
                let allPermissions = document.querySelectorAll(`.${group}-permission`);
                let allChecked = Array.from(allPermissions).every(c => c.checked);

                // If all permissions in this group are checked, check the group checkbox
                document.querySelector(`.group-toggle[data-group="${group}"]`).checked = allChecked;
            });
        });

        // Update left side group checkbox when all checkboxes in a group on the right are checked
        document.querySelectorAll('.permission-checkbox').forEach(cb => {
            cb.addEventListener('change', function () {
                let group = cb.classList.value.split('-')[0]; // Get the group name from the class
                let allPermissions = document.querySelectorAll(`.${group}-permission`);
                let allChecked = Array.from(allPermissions).every(c => c.checked);

                // If all permissions are checked for this group, check the group checkbox on the left
                let groupCheckbox = document.querySelector(`.group-toggle[data-group="${group}"]`);
                groupCheckbox.checked = allChecked;
            });
        });
    });
</script>
@endsection

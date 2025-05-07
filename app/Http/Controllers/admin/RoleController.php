<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();

        $groupedPermissions = $permissions->groupBy(function ($permission) {
            // Group by the last word (e.g., 'product' from 'create product')
            $words = explode(' ', strtolower($permission->name));
            return end($words);
        });

        //dd($groupedPermissions);

        return view('admin.role.create', compact('groupedPermissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        $role = Role::create(['name' => $request->name]);

        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);
        toastr()->success('role add  permission successfully!');

        return redirect()->route('admin.roles.index');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $groupedPermissions = $permissions->groupBy(function ($permission) {
            // Group by the last word (e.g., 'product' from 'create product')
            $words = explode(' ', strtolower($permission->name));
            return end($words);
        });

        return view('admin.role.edit', compact('role','groupedPermissions'));  
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
        ]);
    
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();
    
        // Sync permissions
        $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
        $role->syncPermissions($permissions);
    
        toastr()->success('Role and permissions updated successfully!');

        return redirect()->route('admin.roles.index');
    }
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        toastr()->warning('role delete successfully!');

        return redirect()->route('admin.roles.index');
    }
}

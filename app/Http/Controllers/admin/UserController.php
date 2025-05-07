<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'password'  => 'required|string|min:6',
            'roles'     => 'nullable|array',
            'roles.*'   => 'exists:roles,id',
        ]);

        // Create the user
        $user = User::updateOrCreate(
            ['email' => $request->email], // search criteria
            [
                'name'     => $request->name,
                'password' => bcrypt($request->password),
            ]
        );

        // Assign roles (if any)
        if ($request->has('roles')) {
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->syncRoles($roleNames);
        }

        toastr()->success('User created successfully!');
        return redirect()->route('admin.user.index');
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'roles'    => 'nullable|array',
            'roles.*'  => 'exists:roles,id',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => bcrypt($request->password),
            ]);
        }

        $roleNames = Role::whereIn('id', $request->roles ?? [])->pluck('name')->toArray();
        $user->syncRoles($roleNames);

        toastr()->success('User updated successfully!');
        return redirect()->route('admin.user.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $roles = Role::where([]);
        $roles = $roles->paginate(7);
        return view('admin.roles.index', compact('roles'));
    }

    public function view_users($id)
    {
        $role = Role::findOrFail($id);
        $users = $role->users;
        return view('admin.roles.users', compact('role', 'users'));
    }
}

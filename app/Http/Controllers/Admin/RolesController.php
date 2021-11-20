<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::where([]);
        $roles = $roles->paginate(7);
        return view('admin.roles.index', compact('roles'));
    }

    public function view_permissions($id)
    {
        $role= Role::find($id);
        $permissions=$role->permissions;
        return view('admin.roles.permissions', compact('role', 'permissions'));

    }
}

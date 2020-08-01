<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\{Role,Permission};

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $roles = [];

        if (Auth::user()->isAdmin()) {
            $roles = Role::all();
        } else {
            $roles = Role::where('id', '!=', 1)->get();
        }
       
        return view('admin.roles', compact('roles'));
    }

    public function create()
    {
        return view('admin.role');
    }

    public function store(Request $request)
    {
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if ($role) {
            return redirect()->route('admin.papeis.editar',$role);
        }
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $allPermissions = Permission::all();

        if (!Auth::user()->isAdmin() && $id == 1){
            return redirect()->route('admin.papeis');
        }

        return view('admin.role', compact('role','allPermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            return redirect()->route('admin.papeis');
        }
    }

    public function show($id)
    {
        $role = Role::find($id);
        $allPermissions = Permission::all();

        return view('admin.permissions', compact('role','allPermissions'));
    }

    public function storePermission(Request $request, $id)
    {
        $permission = Permission::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if ($permission) {
            return redirect()->route('admin.papeis.permissoes',$id);
        }
    }

    public function updatePermissions(Request $request, $id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->permissions()->sync($request->permissions);
            return redirect()->route('admin.papeis');
        }
    }

}

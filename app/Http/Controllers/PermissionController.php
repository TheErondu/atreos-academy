<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('dashboard.admin.permissions.index',compact('permissions'));
    }

    public function create()
    {
        return view('dashboard.admin.permissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

         Permission::create(['name' => $request->input('name')]);
         return redirect()->route('permissions.index') ->with('success','Permission created successfully');
    }

}

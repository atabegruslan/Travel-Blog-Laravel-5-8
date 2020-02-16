<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        
        return view('role.index', ['param' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        
        return view('role.create', ['permissions' => $permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]); 

        $role       = new Role;
        $role->name = $request->input('name');

        $role->save();

        $permissions = $request->input('permission_ids');
        $role->syncPermissions($permissions);

        \Session::flash('success', 'Role Created');

        return redirect('role');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::where('id', $id)->first();
        $permissions = $role->permissions()->get();

        return view('role.show', ['param' => $role, 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        $permissions = Permission::all();
        $selectedPermissions = $role->permissions()->get();
        $selectedPermissionIds = $selectedPermissions->pluck('id')->toArray();

        return view('role.edit', ['param' => $role, 'permissions' => $permissions, 'selectedPermissions' => $selectedPermissions, 'selectedPermissionIds' => $selectedPermissionIds]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
        ]); 

        $role = Role::where('id', $id)->first();

        $role->update([
            'name' => $request->input('name'),
        ]);

        $permissions = $request->input('permission_ids');
        $role->syncPermissions($permissions);

        \Session::flash('success', 'Role Updated');

        return redirect('role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::where('id', $id)->first();

        $role->delete();

        \Session::flash('success', 'Role Deleted');

        return redirect('role');
    }
}

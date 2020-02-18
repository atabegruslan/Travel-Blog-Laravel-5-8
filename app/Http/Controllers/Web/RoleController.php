<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;

class RoleController extends Controller
{
    private $feature = 'role';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can($this->feature . '.read')) 
        {
            abort(403);
        }

        $roles = Role::all();
        
        $data = ['items' => $roles, 'feature' => $this->feature];

        return view($this->feature . '.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can($this->feature . '.create')) 
        {
            abort(403);
        }

        $permissions = Permission::all();
        
        $data = [
            'item' => null, 
            'feature' => $this->feature, 
            'permissions' => $permissions,
            'selectedPermissions' => [],
            'selectedPermissionIds' => [],
        ];

        return view($this->feature . '.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can($this->feature . '.create')) 
        {
            abort(403);
        }

        $this->validate($request, [
            'name' => 'required',
        ]); 

        $role       = new Role;
        $role->name = $request->input('name');

        $role->save();

        $permissions = $request->input('permission_ids');
        $role->syncPermissions($permissions);

        \Session::flash('success', ucfirst($this->feature) . ' Created');

        return redirect($this->feature);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!auth()->user()->can($this->feature . '.read')) 
        {
            abort(403);
        }

        $role = Role::where('id', $id)->first();
        $selectedPermissions = $role->permissions()->get();

        $data = [
            'item' => $role, 
            'feature' => $this->feature, 
            'permissions' => [],
            'selectedPermissions' => $selectedPermissions,
            'selectedPermissionIds' => [],
        ];

        return view($this->feature . '.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!auth()->user()->can($this->feature . '.update')) 
        {
            abort(403);
        }

        $role = Role::where('id', $id)->first();
        $permissions = Permission::all();
        $selectedPermissions = $role->permissions()->get();
        $selectedPermissionIds = $selectedPermissions->pluck('id')->toArray();

        $data = [
            'item' => $role, 
            'feature' => $this->feature, 
            'permissions' => $permissions,
            'selectedPermissions' => $selectedPermissions,
            'selectedPermissionIds' => $selectedPermissionIds,
        ];

        return view($this->feature . '.edit', $data);
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
        if (!auth()->user()->can($this->feature . '.update')) 
        {
            abort(403);
        }

        $this->validate($request, [
            'name' => 'required',
        ]); 

        $role = Role::where('id', $id)->first();

        $role->update([
            'name' => $request->input('name'),
        ]);

        $permissions = $request->input('permission_ids');
        $role->syncPermissions($permissions);

        \Session::flash('success', ucfirst($this->feature) . ' Updated');

        return redirect($this->feature);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!auth()->user()->can($this->feature . '.delete')) 
        {
            abort(403);
        }

        $role = Role::where('id', $id)->first();

        $role->delete();

        \Session::flash('success', ucfirst($this->feature) . ' Deleted');

        return redirect($this->feature);
    }
}

<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    private $feature = 'user';

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

        $data = ['feature' => $this->feature];

        return view('user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $user = User::find($id);
        $selectedRoles = $user->roles()->get();

        $data = [
            'item' => $user, 
            'feature' => $this->feature, 
            'roles' => [],
            'selectedRoles' => $selectedRoles,
            'selectedRoleIds' => [],
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

        $user = User::find($id);
        $roles = Role::all();
        $selectedRoles = $user->roles()->get();
        $selectedRoleIds = $selectedRoles->pluck('id')->toArray();

        $data = [
            'item' => $user, 
            'feature' => $this->feature, 
            'roles' => $roles,
            'selectedRoles' => $selectedRoles,
            'selectedRoleIds' => $selectedRoleIds,
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

        $user = User::where('id', $id)->first();

        $roles = $request->input('role_ids');
        $user->syncRoles($roles);

        \Session::flash('success', ucfirst($this->feature) . ' Roles Updated');

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
        //
    }
}

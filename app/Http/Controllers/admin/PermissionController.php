<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('admin.permissions.index')
            ->with([
                'permissions' => $permissions,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();

        return view('admin.permissions.create')
            ->with([
                'roles' => $roles,
            ]);
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
            'name' => 'required|max:40',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        if ($request->roles != '') {
            foreach ($request->roles as $key => $value) {
                $role = Role::find($value);
                $role->permissions()->attach($permission);
            }
        }

        $request->session()->flash('success', 'Permission added successfully');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        $roles = Role::get();

        return view('admin.permissions.edit')
            ->with([
                'permission' => $permission,
                'roles' => $roles,
            ]);
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
        $permission = Permission::findOrFail($id); //Get role with the given id
        //Validate name and permission fields
        $this->validate($request, [
            'name' => 'required',
        ]);

        $input = $request->except(['roles']);
        $permission->fill($input)->save();
        if ($request->roles != '') {
            $permission->roles()->sync($request->roles);
        }

        $request->session()->flash('success', 'Permission updated successfully');

        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission->delete();

        $request->session()->flash('success', 'Permission deleted successfully!');

        return redirect()->route('admin.permissions.index');
    }
}

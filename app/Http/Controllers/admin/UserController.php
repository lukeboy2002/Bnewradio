<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('admin.users.index')
            ->with([
                'users' => $users,
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

        return view('admin.users.create')
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
            'username' => [
                'required',
                'string',
                'alpha_dash',
                'max:255',
                Rule::unique(User::class),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'roles' => 'required',
        ]);

        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        if ($request->roles != '') {
            $user->roles()->attach($request->roles);
        }

        $request->session()->flash('success, User has been created');

        return redirect()->route('admin.users.index');
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
        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('admin.users.edit')
            ->with([
                'user' => $user,
                'roles' => $roles,
            ]);

        return view('admin.users.edit');
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
        $user = User::findOrFail($id);

        $input = $request->except('roles');
        $user->fill($input)->save();

        if ($request->roles != '') {
            $user->roles()->sync($request->roles);
        } else {
            $user->roles()->detach();
        }

        $request->session()->flash('success', "The user {$user->username} has been changed");

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $request->session()->flash('success', 'User has been deleted');

        return redirect()->route('admin.users.index');
    }

    public function trashed()
    {
        $user = User::onlyTrashed()->get();

        return view('admin.users.index')
            ->with([
                'users' => $users,
            ]);
    }

    public function trashedRestore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return back();
    }

    public function trashedDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return back();
    }

    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-'.$user->id)) {
                echo $user->name.' is online. Last seen: '.Carbon::parse($user->last_seen)->diffForHumans().' <br>';
            } else {
                echo $user->name.' is offline. Last seen: '.Carbon::parse($user->last_seen)->diffForHumans().' <br>';
            }
        }
    }
}

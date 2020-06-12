<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    public function show(User $user){
        $roles = Role::all();
        return view('users.profile', compact('user', 'roles'));
    }

    public function update(User $user){
        request()->validate([
            'username'=> ['required', 'string', 'max:255', 'alpha_dash'],
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'max:255'],
            'avatar'=> ['file'],
        ]);
        $user->username = request()->username;
        $user->name = request()->name;
        $user->email = request()->email;
        if(request('avatar'))
        {
            $user->avatar = request()->avatar->store('images');
        }
        $user->save();
        return back();
    }

    public function index(){
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function deleteUser(User $user){
        $user->delete();
        session()->flash('user-deleted', 'User has been deleted');
        return back();
    }

    public function attachRole(User $user){
        $roleId = request()->role;
        $role = Role::findOrFail($roleId);
        if($user->userHasRole($role->name))
        {
            return;
        }
        $user->roles()->attach($roleId);
        return back();
    }

        public function detachRole(User $user){
        $roleId = request()->role;
        $role = Role::findOrFail($roleId);
        if(!$user->userHasRole($role->name))
        {
            return;
        }
        $user->roles()->detach($roleId);
        return back();
    }
}
 
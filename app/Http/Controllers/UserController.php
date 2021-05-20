<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $input = $request->json();

        $role = Role::firstOrCreate(['name' => 'client']);

        $user = new User();

        $user->uid = $input->get('uid');
        $user->name = $input->get('name');
        $user->email = $input->get('email');
        $user->role_id = $role->id;

        $user->save();

        return $user;
    }

    public function currentUser(Request $request)
    {
        $uid = $request->user->uid;
        return User::with('role')->where('uid', $uid)->first();
    }

    public function update(Request $request)
    {
        $input = $request->json();

        $user = User::where('uid', $request->user->uid)->first();

        $user->name = $input->get('name', $user->name);
        $user->email = $input->get('email', $user->email);
        $user->phone_number = $request->get('phone_number', $user->phone_number);

        $user->save();

        return $user;
    }
}

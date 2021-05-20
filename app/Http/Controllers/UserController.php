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
}

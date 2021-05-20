<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->json();

        $user = new User();
        $user->name = $input->get('name');
        $user->email = $input->get('email');
        $user->fcm = $input->get('fcm');
        $user->save();

        return $user;
    }

    public function findAll()
    {
        return User::all();
    }

    public function findById(String $id)
    {
        return User::find($id);
    }

    public function update(Request $request, String $id)
    {
        $input = $request->json();

        $user = User::find($id);

        $user->name = $input->get('name', $user->name);
        $user->email = $input->get('email', $user->email);
        $user->fcm = $input->get('fcm', $user->fcm);

        $user->save();

        return $user;
    }

    public function delete(String $id)
    {
        $user = User::find($id);
        $user->delete();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Role;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->json();

        $role = new Role();
        $role->name = $input->get('name');
        $role->save();

        return $role;
    }

    public function findAll()
    {
        return Role::all();
    }

    public function findById(String $id)
    {
        return Role::find($id);
    }

    public function update(Request $request, String $id)
    {
        $input = $request->json();

        $role = Role::find($id);

        $role->name = $input->get('name', $role->name);

        $role->save();

        return $role;
    }

    public function delete(String $id)
    {
        $role = Role::find($id);
        $role->delete();
    }
}

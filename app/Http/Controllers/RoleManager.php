<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleManager extends Controller
{

    public function permissionsIndex()
    {
        return Permission::all()->paginate(100);
    }


    public function rolesIndex()
    {
        $veri = Role::all()->paginate(100);
        return view('roles/show')->with($veri);
    }



    public function rolesAddUser(Request $request, Role $role, User $user)
    {

        $user->assignRole($role);

        return response()->json([
            "message" => $role->name . " Role successfully assigned to User!"
        ], 200);
    }


    public function rolesRemoveUser(Request $request, Role $role, User $user)
    {
        $user->removeRole($role);

        return response()->json([
            "message" => $role->name . " Role successfully removed from User"
        ], 200);
    }
}

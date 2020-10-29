<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Http\Request;

class UserService {

    public function InsertRoles ($user, $request) {
        if ( $request->role != null ) {
            return $user->roles()->attach($request->role);
        }
    }

    public function InsertPermissions ($user, $request) {
        if ( $request->permissions != null ) {
            foreach ( $request->permissions as $permission ) {
                $user->permissions()->attach($permission);
            }
        }
    }

    public function updateRoles ($user, $request) {
        if ( $request->role != null ) {
            $user->roles()->detach();
            $user->roles()->attach($request->role);
        }
    }

    public function updatePermissions ($user, $request) {
        if ( $request->permissions != null ) {
            $user->permissions()->detach();
            foreach ( $request->permissions as $permission ) {
                $user->permissions()->attach($permission);
            }
        }
    }

}
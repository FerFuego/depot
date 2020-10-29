<?php

namespace App\Services;

use App\Models\Permission;
use Illuminate\Http\Request;

class RoleService {

    public function addPermissions ( $role, $request ) {

        $permissions = explode( ',', $request->roles_permissions );

        foreach ( $permissions as $p ) {
            
            $permission = Permission::create([
                'name' => $p,
                'slug' => strtolower( str_replace(' ','-', $p) )
            ]);

            $role->permissions()->attach( $permission->id );
        }

    }

    public function updatePermissions ( $role, $request ) {

        $role->permissions()->delete(); 
        $role->permissions()->detach(); 

        $this->addPermissions($role, $request);
    }

}
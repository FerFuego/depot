<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();

        return view('users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ( $request->ajax()) {
            $role = Role::where('id', $request->role_id)->first();
            $permissions = $role->permissions;
            return $permissions;
        }

        $roles = Role::all();
        
        return view('users.create',[
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, UserService $service)
    {
        $params = $request->all();

        $params['password'] = Hash::make($request->password);

        $user = User::create($params);

        $service->InsertRoles($user, $request);

        $service->InsertPermissions($user, $request);

        session()->flash('success','Usuario Creado Correctamente!');

        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        $roles = Role::all();
        $userRole = $user->roles->first();
        $allPermissions = $userRole->permissions;
        
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'allPermissions' => $allPermissions
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, UserService $service)
    {
        $params = $request->all();

        if ( $request->password == null) {
            unset($params['password']);
        } else {
            $params['password'] = Hash::make( $request->password );
        }

        $user->fill( $params )->update();
        $service->updateRoles($user, $request);
        $service->updatePermissions($user, $request);

        $roles = Role::all();
        $userRole = $user->roles->first();
        $allPermissions = $userRole->permissions;

        session()->flash('success','Usuario Actualizado Correctamente!');

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'allPermissions' => $allPermissions
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->roles()->detach();
        $user->permissions()->detach();
        $user->delete();

        session()->flash('success','Usuario Eliminado Correctamente!');

        return redirect('/users');
    }
}

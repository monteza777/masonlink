<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index_user_roles',compact('roles'));

    }

    public function create()
    {
        return view('roles.create_user_roles');
        //
    }

    public function store(Request $request)
    {
        // $this->validate($request,
        //     [
        //     'role_name'=>'required | unique:roles',
        //     'desc'=>'required| unique:roles',
            
        //     ]);

        $roleName = $request['role_name'];
        $description = $request['desc'];

        $user = new Role();
        // db -> FORM NAME
        $user->name=$roleName;
        $user->description=$description;
         $user->save();
        return redirect('/roles');
    }

   
    public function show($id)
    {
        $roles = Role::findOrFail($id);
        return view('roles.show_user_roles',compact('roles'));
    }

   
    public function edit($id)
    {
        $roles = Role::findorFail($id);
        return view('roles.edit_user_roles',compact('roles'));
    }

    
    public function update(Request $request, $id)
    {
        $rolesUpdate = Role::find($id);
        $this->validate($request,['edit_role_name'=>'required']);

        $rolesUpdate->name = $request->edit_role_name;
        $rolesUpdate->description = $request->edit_desc;
        
        $rolesUpdate->save();
        session()->flash('message','Updated Succesful');
        return redirect('/roles');
    }
    
    public function destroy($id)
    {
        $userDelete = Role::find($id);
        $userDelete->delete();
        return redirect('/roles');
    }
}

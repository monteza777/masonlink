<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\lodge;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Query\Builder\detach;

class UsersController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
            
    public function index()
    {
    $countUsers = User::count();
    $search = \Request::get('search');
    $roles = Role::all();
    $users = User::where('firstname', 'like', '%'.$search.'%')
    ->orderBy('created_at','desc')
    ->paginate(5);
    

    $data = [
        'countUsers' => $countUsers,
        'users' => $users,
        'roles' => $roles,
    ];
    return view('users.userlist')->with($data);
    }

    public function create(Request $request)
    {
        $lodge = lodge::all();
        $roles = Role::all();
        $data = [
            'roles' => $roles,
            'lodge' => $lodge,
        ];
        return view('users.create_users')->with($data);
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
            'fname'=>'required|max:120',
            'email'=>'required | email | unique:users',
            'password'=>'required|min:5|confirmed',
            'user_role'=>'required',
            'user_lodge'=>'required',
            ]);

        //$userId = $request['user_id'];
        $email = $request['email'];
        $fname = $request['fname'];
        $mname = $request['mname'];
        $lname = $request['lname'];
        $contactNum = $request['contactNum'];
        $HomeAdd= $request['HomeAdd'];
        $mTitle= $request['members_title'];
        $userLodge= $request['user_lodge'];
        $userRole= $request['user_role'];
        $pw=bcrypt($request['password']);

        $user = new User();
        // db -> FORM NAME
        $user->email=$email;
        $user->password=$pw;
        $user->firstname=$fname;
        $user->middlename=$mname;
        $user->lastname=$lname;
        $user->contact_number=$contactNum;
        $user->members_title=$mTitle;
        $user->user_lodge=$userLodge;
        $user->user_role=$userRole;

        $user->save();
        $user->roles('name')->attach($userRole);
        return redirect('/users');
    }   

    public function show($id)
    {
       $user = User::findOrFail($id);
        return view('users.show_users',compact('user'));
    }

    public function edit($id)
    {
        $lodge = lodge::all();
        $roles = Role::all();
        $users = User::find($id);
        // $oldTitle = Request::old('members_title');

        foreach ($users->roles as $users_role) {
            $currentRole = $users_role;
        }

        

        $data = [
            'users' => $users,
            'roles' => $roles,
            'currentRole'   => $currentRole,
            'lodge'   => $lodge,
        ];

        return view('users.edit_user')->with($data);
    }

    public function update(Request $request, $id)
    {
        $userRole= $request['edit_user_role'];

        $userUpdate = User::find($id);
        $this->validate($request,['email'=>'required']);

        $userUpdate->email = $request->email;
        $userUpdate->firstname = $request->fname;
        $userUpdate->middlename = $request->mname;
        $userUpdate->lastname= $request->lname;
        $userUpdate->contact_number= $request->contactNum;
        $userUpdate->members_title= $request->members_title;
        $userUpdate->user_lodge= $request->edit_user_lodge;
        $userUpdate->user_role = $request->edit_user_role;
        $userUpdate->save();
        $userUpdate->roles('name')->detach();
        $userUpdate->roles('name')->attach($userRole);
        session()->flash('message','Updated Succesful');
        return redirect('/users');
    }

    public function destroy($id)
    {
        $userDelete = User::find($id);
        $userDelete->posts()->delete();
        $userDelete->delete();
        return redirect('/users');
    }

    public function getAccount(){
        return view('users.account', ['user' => Auth::user()]);
    }

    public function PostSaveAccount(Request $request){
        $this->validate($request,[
            'firstname'=>'required|max:120',
            'email'=>'required|email',
            'lname'=>'required'
        ]);
        $user = Auth::user();
        $user->firstname = $request['firstname'];
        $user->middlename = $request['mname'];
        $user->lastname = $request['lname'];
        $user->email = $request['email'];
        $user->contact_number = $request['contactNum'];
        $user->home_address = $request['HomeAdd'];
        $user->update();
        $file = $request->file('image');
        $filename = $user->id .'.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file)); 
        }
        return redirect()->route('account');
    }

    public function getUserImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }
}

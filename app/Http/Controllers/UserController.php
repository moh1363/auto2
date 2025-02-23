<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use lang;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view ('Users.index',compact('users'));
    }
    public function create(){
        return view ('users.create');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'title' => 'required',
            'personnel_id' => 'required|unique:users,personnel_id',
            'email' => 'required|email|unique:users,email',
            // 'roles' => 'required',
//            'permissions' => 'required',




        ]);
        $user = new User();
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->title = $request->get('title');
        $user->phone = $request->get('phone');
        $user->personnel_id = $request->get('personnel_id');
        $user->email = $request->get('email');
        $user->password = bcrypt('123456');
        $user->save();
        // $user->assignRole($request->get('roles'));
        // $permissionsids = $request->get('permissions');

        // $user->permissions()->attach($permissionsids);

        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت اضافه گردید');;

    }

  
   
}

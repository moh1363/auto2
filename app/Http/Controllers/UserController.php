<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\PostTitle;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users=User::all();

        return view ('Users.index',compact('users'));
    }
    public function create(){
        $posttitles=PostTitle::all();

        return view ('users.create',compact('posttitles'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'personnel_id' => 'required|unique:users,personnel_id',
            'email' => 'required|email|unique:users,email',
            // 'roles' => 'required',
//            'permissions' => 'required',




        ]);
        $user = new User();
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->phone = $request->get('phone');
        $user->personnel_id = $request->get('personnel_id');
        $user->post_title_id = $request->get('post_title_id');
        $user->email = $request->get('email');
        $user->password = bcrypt('123456');
        $user->save();
        // $user->assignRole($request->get('roles'));
        // $permissionsids = $request->get('permissions');

        // $user->permissions()->attach($permissionsids);

        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت اضافه گردید');;

    }

    public function edit($id){
        $user=User::find($id);
        $posttitles=PostTitle::all();

        return view ('users.edit',compact('posttitles','user'));
    }
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([

            'firstname' => 'required',
            'lastname' => 'required',
            'personnel_id' => 'required |unique:users,personnel_id,' . $id,
            'email' => 'required |unique:users,email,' . $id,
            // 'roles' => 'required',
//            'permissions' => 'required',




        ]);
        $user = User::find($id);
        $user->firstname = $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->phone = $request->get('phone');
        $user->personnel_id = $request->get('personnel_id');
        $user->post_title_id = $request->get('post_title_id');
        $user->email = $request->get('email');
        $user->password = bcrypt('123456');
        $user->update();
        // $user->assignRole($request->get('roles'));
        // $permissionsids = $request->get('permissions');

        // $user->permissions()->attach($permissionsids);

        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت ویرایش گردید');;

    }
    public function destroy ($id){
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'کاربر با موفقیت حذف گردید');;

    }

    public function show($id){
        $user=User::find($id);
        $posttitles=PostTitle::all();

        return view ('users.show',compact('posttitles','user'));
    }

}

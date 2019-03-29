<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sale;
use App\Product;
use DB;

class UserController extends Controller
{
    public function viewUsers()
    {
        //$users = User::all();

        $users = DB::table('users')->get();
        foreach ($users as $user) {
            if ($user->role_id == null || $user->role_id == 1) {
                $user->roleName = 'Admin/Manager';
            } else {
                $user->roleName = 'User/Employee';
            }
        }

        return view('panel.user.viewUsers')
            ->with('users', $users)
            ->with('firstMsg', 'System Users/Employee');
    }


    public function newUser()
    {
        return redirect('/register');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return view('panel.user.editUser')->with('user', $user);
    }

    public function update(Request $request)
    {
        $user = new User();
        $user->find($request->id)->fill($request->all())->save();
        return redirect()->back()->with('msg', 'User record updated successfully.');
    }
}

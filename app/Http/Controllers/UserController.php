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

        return view('panel.user.viewUsers')
            ->with('users', $users)
            ->with('firstMsg', 'Software Users');
    }


    public function newUser()
    {
        return redirect('/register');
    }

    public function editUser($id)
    {
        $phoneNumber = $id;
        $user = User::where('phoneNumber', $phoneNumber)->first();
        return view('panel.user.editUser')->with('user', $user);
//        return $user;
    }

    public function update(Request $request)
    {
        $user = new User();
        $user->find($request->id)->fill($request->all())->save();
        return redirect()->back()->with('msg', 'User record updated successfully.');
    }
}

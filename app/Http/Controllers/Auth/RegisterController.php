<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function StoreUser(Request $req)
    {
    	$this->validate($req,[
    		'email' => 'required|email|max:191|unique:users,email',
    		'name' => 'required|max:255|min:2',
    		'password' => 'required|min:6|max:32',
    		'passwordConfirmed' => 'required|same:password'
    	]);

    	$u = new User();
    	$u->email = $req->email;
    	$u->password = bcrypt($req->password);
    	$u->name = $req->name;
    	$u->isAdmin = 0;
    	
    	if($u->save())
    	{
    		return redirect('login')->with('success','Log in now!');
    	}

    	return back()->with('error','Please try again!');
    }
}

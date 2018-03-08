<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    public function Register(Request $req)
    {
    	$this->validate($req,[
    		'email' => 'required|email|max:191',
    		'name' => 'required|max:255|min:2',
            'photo' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg',
    		'password' => 'required|min:6|max:32',
    		'passwordConfirmed' => 'required|same:password'
    	]);

    	$u = $req->all();
    	$u['email'] = $req->get('email');
    	$u['password'] = bcrypt($req->get('password'));
        $u['passwordConfirmed'] = bcrypt($req->get('passwordConfirmed'));
        $u['name'] = $req->get('name');
    	$u['isAdmin'] = 0;

        $file = $req->file('photo');

        if ($file) {
            $file_name = str_random(5) . $file->getClientOriginalName();
            $file->move('images'.DIRECTORY_SEPARATOR.'users', $file_name);
            $u['image_path'] = 'images'.DIRECTORY_SEPARATOR.'users' . DIRECTORY_SEPARATOR . $file_name;
        }
  	if(User::create($u))
    	{
    		return redirect('users/login')->with('success','Log in now!');
    	}

    	return back()->with('error','Please try again!');
    }
}

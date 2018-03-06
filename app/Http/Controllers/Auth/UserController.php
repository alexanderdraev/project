<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function Index($id)
    {
        if(!$id)
        {
            return redirect(404);
        }
        $user = User::where('id',$id)->get();
        return view('users.index', ['user' => $user]);
    }

    public function Edit($id){
         if(!$id)
        {
            return redirect(404);
        }
        $user = User::where('id',$id)->first();
        return view('users.edit', ['user' => $user]);
    }

    public function Update(Request $req, $id)
    {

    }

    public function Destroy($id)
    {
        $user = User::where('id', $id)->first();
        if(!$user)
        {
            return redirect(404);
        }

        if($user->image_path)
        {
            File::delete($user->image_path);
        }

        if($user->delete())
        {
            return back()->with('success','User deleted successfully.');
        }

        return back()->with('error','Could not delete user.');
    }
}

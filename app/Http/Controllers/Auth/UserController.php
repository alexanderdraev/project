<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use File;
use Auth;
class UserController extends Controller
{
    public function Index($id=null)
    {
        if(isset($id))
        {
            $user = User::where('id',$id)->get()->first();
            if(empty($user))
            {
                return redirect()->route('users.index');
            }
        }
        else{
            $user = User::all(['id','name','email','created_at','image_path']);
        }
        return view('users.index', ['user' => $user,'id'=>$id]);
    }

    public function Edit($id)
    {
        if (!$id) {
            return redirect(404);
        }
        if (Auth::check() && Auth::id() == $id) {
            $user = User::where('id', $id)->first();
            return view('users.edit', ['user' => $user]);
        }
        return redirect()->route('users.index')->with('error','You can not update this profile.');
    }

    public function Update(Request $req, $id)
    {
        $this->validate($req, [
            'name' => 'required|max:255',
            'email' => 'required|max:191',
            'photo' => 'mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg'
        ]);

        $model = User::where('id', $id)->first();
        if (!$model) {
            return redirect(404);
        }

        $model->name = $req['name'];
        $model->email = $req['email'];

        $photo = $req->file('photo');
        if ($photo) {
            File::delete($model->image_path);
            $fileName = str_random(5) . $photo->getClientOriginalName();
            $photo->move('images'.DIRECTORY_SEPARATOR.'users', $fileName);
            $model->image_path = 'images' .DIRECTORY_SEPARATOR.'users' . DIRECTORY_SEPARATOR . $fileName;
        }

        if ($model->save()) {
            return back()->with('success', 'User updated successfully.');
        }
        return back()->with('error', 'Could not update user.');
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

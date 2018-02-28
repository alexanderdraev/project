<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{

    public function Create($post_id,$user_id)
    {
        //pass necessary parameter, not in this way probably
        return view('comments.create',['post_id'=>$post_id,'user_id'=>$user_id]);
    }
    public function Store(Request $req)
    {
        $this->validate($req,[
            'content'=>'required',
            //post_id and user_id to be used to find their names
        ]);


        /*if(!Comment::create($model))
        {
            return back()->with('message','error');                           TO BE FINISHED
        }

        return back()->with('message','success');*/
    }
    public function Show()
    {

    }
    public function Edit($id)
    {

    }
    public function Update(Request $req,$id)
    {
    }
    public function Destroy($id)
    {
        $comment = Comment::where('id',$id)->first();
        $comment->delete();
    }
}

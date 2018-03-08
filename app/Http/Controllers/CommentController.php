<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Auth;
class CommentController extends Controller
{

    public function Store(Request $req,$id)
    {
        $this->validate($req, [
            'content' => 'required',
        ]);

        $model = $req->all();
        $model['post_id'] =$id;
        $model['user_id'] = Auth::id();
       if(!Comment::create($model))
        {
            return redirect()->route('posts.index',$id)->with('error','Can not add comment.');
        }
        return redirect()->route('posts.index',$id)->with('success','Comment added successfully.');
    }
    public function Update(Request $req,$id,$c_id)
    {
        $this->validate($req, [
            'content' => 'required',
        ]);

        $model = Comment::where('id',$c_id)->first();
        $model->content = $req['content'];
        if(!$model->save())
        {
            return back()->with('error','Can not update comment.');
        }
        return back()->with('success','Comment updated successfully.');
    }
    public function Destroy($id,$c_id)
    {
        $comment = Comment::where('id',$c_id)->first();
        if(!$comment)
        {
            return redirect(404);
        }

        if($comment->delete())
        {
            return back()->with('success','Comment deleted successfully.');
        }

        return back()->with('error','Could not delete comment.');
    }
}

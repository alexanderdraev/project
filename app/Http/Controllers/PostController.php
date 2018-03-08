<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Auth;
use File;

class PostController extends Controller
{

    public function Index($id=null)
    {
        if (isset($id)){
            $post = Post::where('id',$id)->get()->first();
            if(empty($post))
            {
                return redirect()->route('posts.index');
            }
            $post = Post::where('id',$id)->get();
            $comments = Comment::where('post_id',$id)->get();
            return view('posts.index', ['posts' => $post,'comments'=>$comments,'id'=>$id]);
        }
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts,'comments'=>new Comment(),'id'=>$id]);
    }

    public function Create()
    {
        $categories = Category::all('id', 'category_name');

        return view('posts.create', ['categories' => $categories],['post'=>new Post()]);
    }

    public function Store(Request $req)
    {
        $this->validate($req, [
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required|nullable',
            'photo' => 'required|mimes:jpeg,jpg,png'
        ]);

        $model = $req->all();

        $c = Category::where('category_name', $model['category'])->first();
        $model['category_id'] = $c->id;
        $model['user_id'] = Auth::id();
        $file = $model['photo'];
        if ($file) {
            $fileName = str_random(5) . $file->getClientOriginalName();
            $file->move('images', $fileName);
            $model['imagePath'] = 'images' . DIRECTORY_SEPARATOR . $fileName;
        }
        if (!Post::create($model)) {
            return back()->with('error', 'Could not create post.');
        }

        return back()->with('success', 'Post added successfully.');
    }

    public function Edit($id)
    {
        $post = Post::where('id', $id)->first();
        if (Auth::check() && Auth::id()===$post->user_id){
            $categories = Category::all('id', 'category_name');
            return view('posts.create', ['post' => $post, 'categories' => $categories]);
        }
        return redirect()->route('posts.index')->with('error','You can not edit this post.');
    }

    public function Update(Request $req, $id)
    {
        $this->validate($req, [
            'title' => 'required|max:255',
            'content' => 'required',
            'category' => 'required',
            'photo' => 'mimes:jpeg,jpg,png'
        ]);

        $model = Post::where('id', $id)->first();
        if (!$model) {
            return redirect(404);
        }

        $model->title = $req['title'];
        $model->content = $req['content'];
        $c = Category::where('category_name', $req['category'])->first();
        $model->category_id = $c->id;
        $model->user_id = Auth::id();

        $photo = $req->file('photo');
        if ($photo) {
            File::delete($model->imagePath);
            $fileName = str_random(5) . $photo->getClientOriginalName();
            $photo->move('images', $fileName);
            $model->imagePath = 'images' . DIRECTORY_SEPARATOR . $fileName;
        }

        if ($model->save()) {
            return back()->with('success', 'Post updated successfully.');
        }
        return back()->with('error', 'Could not update post.');
    }

    public function Destroy($id)
    {
        $post = Post::where('id', $id)->first();
        if(!$post)
        {
            return redirect(404);
        }

        if($post->imagePath)
        {
            File::delete($post->imagePath);
        }

        if($post->delete())
        {
            return back()->with('success','Post deleted successfully.');
        }

        return back()->with('error','Could not delete post.');
    }

}

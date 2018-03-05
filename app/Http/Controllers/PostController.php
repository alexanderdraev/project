<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Auth;
use File;

class PostController extends Controller
{

    public function Index($id=null)
    {
        if(!isset($id)) {
            $posts = Post
                ::join('categories', 'posts.category_id', '=', 'categories.id')
                ->join('users', 'posts.user_id', '=', 'users.id')
                ->select('posts.title', 'posts.content', 'categories.category_name', 'users.name', 'posts.updated_at', 'posts.imagePath')
                ->get();
        }
        if (isset($id)){
            $post = Post::where('id',$id)->get();
            return view('posts.index', ['posts' => $post]);
        }
        $posts = Post::paginate(5);
        return view('posts.index', ['posts' => $posts]);
    }

    public function Create()
    {
        $categories = Category::all('id', 'category_name');

        return view('posts.create', ['categories' => $categories,'post'=>new Post]);
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
        $categories = Category::all('id', 'category_name');
        return view('posts.create', ['post' => $post, 'categories' => $categories]);
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

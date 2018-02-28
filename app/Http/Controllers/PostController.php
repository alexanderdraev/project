<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;

class PostController extends Controller
{
    public function Create()
    {

    	return view('posts.form');
    }

    public function Store(Request $req)
    {
    	$this->validate($req,[
    		'title' => 'required|max:255',
    		'text' => 'required',
    		'photo' => 'required|max:1024',
    	]);

    	$model = $req->all();

    	$file = $model['photo'];

    	if($file)
    	{
    		$fileName = str_random(5).$file->getClientOriginalName();
    		$file->move('images', $fileName);
    		$model['imagePath'] = 'images'.DIRECTORY_SEPARATOR.$fileName;
    	}
    	

    	if(Post::create($model))
    	{
    		return back()->with('message','success');
    	}

    	return back()->with('message','error');
    }

    public function Index()
    {
    	$posts = Post::paginate(1);

    	return view('posts.index', ['posts' => $posts]);
    }
}

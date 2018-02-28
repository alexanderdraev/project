<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
	public function Index()
    {
    	$posts = Post::paginate(5);

    	return view('posts.index', ['posts' => $posts]);
    }
     public function Create()
    {
    	$categories = Category::all('category_name');
        return view('posts.create',['categories'=>$categories]);
    }
     public function Store(Request $req)
    {
    	$this->validate($req,[
    		'title'=>'required|max:255',
    	    'content'=>'required',
    	    'category' => 'required',
            'photo'=>'required|mimes:jpeg,jpg,png'
    	]);

    	$model['title'] = $req->get('title');
        $model['content'] = $req->get('content');
    	$model['category_id']=Category::all('id')->where('category_name','=',$req->get('category'))->first();
        $model['user_id']=Auth::id();

    	$file = $req->get('photo');

    	if($file)
    	{
    		$fileName = str_random(5).$file->Post::getClientOriginalName();
    		$file->Storage::move('images', $fileName);
    		$model['imagePath'] = 'images'.DIRECTORY_SEPARATOR.$fileName;
    	}

    	if(!Post::create($model))
    	{
    		return back()->with('message','error');
    	}

    	return back()->with('message','success');
    }
    public function Show()
    {
        $posts = Post
            ::join('categories', 'posts.category_id', '=', 'categories.id')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.title', 'posts.content', 'categories.category_name','users.username','posts.updated_at')
            ->get();
        return view('posts.show',['posts'=>$posts]);
    }
    public function Edit($id)
    {
        $post = Post::where('id',$id)->first();
        return view('posts.create',['post'=>$post]);
    }
    public function Update(Request $req,$id)
    {
        $this->validate($req,[
            'title'=>'required|max:255',
            'content'=>'required',
            'category' => 'required',
            'photo'=>'max:1024'
        ]);

        $model = Post::where('id',$id)->first();
        $model->title = $req->get('title');
        $model->content = $req->get('content');
        $model->category_id=Category::get('id')->where('category_name','=',$req->get('category'));
        $model->user_id=Auth::id();

        $file = $req->get('photo');

        if($file)
        {
            $fileName = str_random(5).$file->getClientOriginalName();
            $file->move('images', $fileName);
            $model['imagePath'] = 'images'.DIRECTORY_SEPARATOR.$fileName;
        }
        if(!Post::save($model))
        {
            return back()->with('message','error');
        }

        return back()->with('message','success');
    }
    public function Destroy($id)
    {
        $post = Post::where('id',$id)->first();
        $post->delete();
    }

    
}

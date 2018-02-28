<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function Index()
    {
        $categories = Category::all('category_name');
        return view('categories.index', ['categories' => $categories]);
    }
    public function Create()
    {
        return view('categories.create');
    }
    public function Store(Request $req)
    {
        $this->validate($req,[
            'category_name'=>'required|max:191'
        ]);

        $model= $req->all();

        if(!Category::create($model))
        {
            return back()->with('message','error');
        }

        return back()->with('message','success');
    }

    public function Edit($id)
    {
        $category = Category::where('id',$id)->first();
        return view('categories.create',['category'=>$category]);
    }
    public function Update(Request $req,$id)
    {
        $this->validate($req,[
            'category_name'=>'required|max:191'
        ]);

        $model = Category::where('id',$id)->first();
        $model['category_name'] = $req->get('category_name');

        if(!Post::save($model))
        {
            return back()->with('message','error');
        }

        return back()->with('message','success');
    }
    public function Destroy($id)
    {
        $category = Category::where('id',$id)->first();
        $category->delete();
    }
}

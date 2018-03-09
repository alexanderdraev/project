<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function Index()
    {
        $categories = Category::all('id','category_name');
        return view('categories.index', ['categories' => $categories]);
    }
    public function Create()
    {
        return view('categories.create',['category'=>new Category()]);
    }
    public function Store(Request $req)
    {
        $this->validate($req,[
            'category_name'=>'required|max:191'
        ]);

        $model= $req->all();

        if(!Category::create($model))
        {
            return back()->with('error','Can not create category.');
        }

        return redirect()->route('categories.index')->with('success','Category added successfully.');
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
        $model->category_name = $req['category_name'];

        if ($model->save()) {
            return back()->with('success', 'Category updated successfully.');
        }
        return back()->with('error', 'Could not update category.');
    }
    public function Destroy($id)
    {
        $category = Category::where('id',$id)->first();
        if(!$category)
        {
            return redirect(404);
        }

        if($category->delete())
        {
            return back()->with('success','Category deleted successfully.');
        }

        return back()->with('error','Could not delete category.');
    }
}

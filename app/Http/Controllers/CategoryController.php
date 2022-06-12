<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class CategoryController extends Controller
{
    public function index()
    {
        # code...
        $categories = Category::paginate(10);
        return view('client.category.index',[
            'categories'=>$categories
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:50',
            'description'=>'required|max:255',
        ]);

        $request->user()->categories()->create([
            'id'=>Uuid::uuid4(),
            'name'=>$request->name,
            'description'=>$request->description,
            'show_nav'=> $request->has("show_nav")?"1":"0"
        ]);
        return back();
    }

    public function destroy(Category $category){
        Category::destroy($category->id);
        return back();
    }

    public function get(Category $category){
        return $category;
    }
    public function update($id, Request $request){
        // dd($id);
        Category::where('id',$id)->update($request->only('name','description','show_nav'));
        return redirect()->route('category');

    }
    public function showInNav(Category $category){
        $category->update([
            'show_nav'=>$category->show_nav==1?0:1
        ]);
        return redirect()->route('category');
        // Category::get();
    }

    public function getProducts(Category $category)
    {
        $categories = Category::paginate(10);
        return view('client.product.category',[
            'products'=>$category->products()->paginate(),
            'categories'=>$categories
        ])->with('title',$category->name." Products");
    }


}

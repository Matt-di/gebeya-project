<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Category;
use Illuminate\Http\Request;

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

    public function destroy(User $user, Category $category){
        Category::destroy($category->id);
        return back();
    }

    public function get(User $user, Category $category){
        return $category;
    }
    public function update(User $user, Category $category, Request $request){
        $category->update($request->only('name','description','show_nav'));
        return redirect()->route('user.category',['user'=>auth()->user()->id]);

    }
    public function showInNav(User $user,Category $category){
        // dd($category);
        $category->update([
            'show_nav'=>$category->show_nav==1?0:1
        ]);
        return redirect()->route('user.category',['user'=>$user->id]);
        // Category::get();
    }

    public function getProducts(User $user, Category $category)
    {
        $categories = Category::paginate(10);
        return view('client.product.category',[
            'products'=>$category->products()->paginate(),
            'categories'=>$categories
        ])->with('title',$category->name." Products");
    }


}

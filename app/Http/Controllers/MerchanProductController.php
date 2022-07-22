<?php

namespace App\Http\Controllers;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v1;

class MerchanProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = Category::get();
        $products = auth()->user()->products()->paginate(10);
        return view('client.product.index', [
            "categories" => $category,
            "products" => $products
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('client.product.create', ["categories" => $categories]);
    }


    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => "required",
            'description' => "required|max:255",
            'price' => "required",
            "quantity" => "required",
            'image' => "required"
        ]);

        $fileName = $this->uploadImage($request);
        // dd($request->category);
        $product = $request->user()->products()->create([
            'id' => Uuid::uuid4(),
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'tags' => $request->tags,
            'image' => $fileName
        ]);
        $product->categories()->attach(Category::find($request->category));

        return back();
    }

    public function edit(User $user, Product $product)
    {
        // dd($product);
        $categories = Category::all();
        return view('client.product.edit', ['product'=>$product,"categories" => $categories]);
    }

    protected function uploadImage($request)
    {
        if ($request->file('image')) {
            if ($request->file('image')) {
                $image = $request->file('image');
                if ($image->isValid()) {
                    $fileName = time() . $image->getClientOriginalName();
                    $image->move(public_path("images/products"), $fileName);
                    return $fileName;
                }
            }
        }
        return "default";
    }
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return back();
    }

    public function show(User $user, Product $product)
    {
        if (Auth::check())
            if (auth()->user()->user_type == 'merchant')
                return view('client.product.single', ['product' => $product]);

        return view('user.product.show', ['product' => $product]);
    }

    public function update(User $user, Product $product, Request $request)
    {
        // dd($product);
        $fileName = $this->uploadImage($request);
        $retn = $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $fileName == "default" ? $product->image : $fileName,
            'tags'=>$request->tags
        ]);

        $product->categories()->attach(Category::find($request->category));
        return redirect()->route('merchant.products.index', auth()->user()->id)->with('message','Product updated!.');
    }

    public function removeCategory(User $user, Category $category, Product $product, Request $request)
    {
        $product->categories()->detach($category);

        return back();
    }
    public function findProduct(User $user, Product $product)
    {
        return $product;
    }
}

<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MerchanProductController extends Controller
{
    public function index()
    {
        $category = Category::get();
        $products = Product::paginate(10);
        return view('client.product.index', [
            "categories" => $category,
            "products" => $products
        ]);
    }
    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => "required",
            'description' => "required|max:255",
            'price' => "required",
            "quantity" => "required",
            "category_id" => "required",
            'image' => "required"
        ]);

        $fileName = $this->uploadImage($request);
        // dd($fileName);
        $request->user()->products()->create([
            'id' => Uuid::uuid4(),
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $fileName
        ]);

        return back();
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

    public function getProduct(Product $product)
    {
        return $product;
    }

    public function update(Product $product, Request $request)
    {
        $fileName = $this->uploadImage($request);
        Product::where('id', $product->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $fileName == "default" ? $product->image : $fileName
        ]);
        return redirect()->route('products');
    }
}

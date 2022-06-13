<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        $categories = Category::paginate(10);
        return view("home", ['products' => $products, 'categories' => $categories]);
    }

    public function getProduct(Product $product)
    {
        return view('product.single', ['product' => $product]);
    }

    public function removeCategory(Product $product,Request $request)
    {
        $category = Category::find($request->category_id);
        $product->categories()->detach($category);

        return back();
    }
}

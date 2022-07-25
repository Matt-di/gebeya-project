<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        User::where('store_status',1);
        if (Auth::check()) {
            $role = Auth::User()->role;

            if ($role == 1) {
                return redirect()->route('admin.dashboard');
            }
        }
        $carts = session()->get('cart');
        if ($carts == null)
            $carts = [];
        $filtered = "Latest Products";
        if (!empty($request->category_id) && $request->category_id != "all") {
            $category = Category::where('id', $request->category_id)->first();
            $filtered = $category->name . " Products";
            $products = $category->products()->latest()->paginate(10);
        } else if ($request->has('filter')) {
            switch ($request->filter) {
                case 'low_price':
                    $filtered = "Low to High Price Products";
                    $products = Product::orderBy('price', "ASC")->paginate(10);
                    break;
                case 'high_price':
                    $filtered = "High to Low Price Products";
                    $products = Product::orderBy('price', "DESC")->paginate(10);
                    break;
                case 'popular':
                    $filtered = "Popular Products";
                    $products = Product::orderBy('price', "ASC")->paginate(10);
                    break;
                case 'rating':
                    $filtered = "Based on Rating Products";
                    $products = Product::orderBy('price', "ASC")->paginate(10);
                    break;
                default:
                    # code...
                    break;
            }
        } else if ($request->price > '0') {
            $filtered = "Products between $0 -$" . $request->price . " Price";
            $products = Product::price($request->price)->paginate(10);
        } else if ($request->search) {
            $products = Product::query()
                ->where('name', 'LIKE', "%{$request->search}%")
                ->orWhere('description', 'LIKE', "%{$request->search}%")
                ->orWhere('tags', 'LIKE', "%{$request->search}%")
                ->paginate(10);
            $filtered = "Search Products :" . $request->search;
        } else {
            $products = Product::latest()->paginate(10);
        }
        $categories = Category::paginate(10)->sortBy("created_at");
        return view("home", ['products' => $products, 'categories' => $categories, "titleProduct" => $filtered, 'cart' => $carts]);
    }


    public function getProduct($id, $product_id)
    {
        $carts = session()->get('cart');
        if ($carts == null)
            $carts = [];
        $product = Product::find($product_id);
        return view('user.product.single', ['product' => $product, 'cart' => $carts]);
    }
    public function getProducts($id, $category)
    {
        $carts = session()->get('cart');
        if ($carts == null)
            $carts = [];
        $categories = Category::paginate(10);
        $store = Category::find($category);
        // dd($store);
        return view('home', [
            'products' => $store->products()->paginate(10),
            'categories' => $categories,
            'cart' => $carts
        ])->with('title', $store->name . " Products");
    }
}

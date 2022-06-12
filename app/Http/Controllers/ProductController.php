<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view("home",['products'=>$products]);
    }

    public function getProduct(Product $product)
    {
        return view('product.single',['product'=>$product]);
    }
}

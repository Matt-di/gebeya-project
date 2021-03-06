<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class MerchantDashboardorController extends Controller
{
    
    public function index()
    {
        $categories = Category::get();
        $your_categ = auth()->user()->categories()->count();
        $product_count = Product::count();
        $your_prod = auth()->user()->products()->count();

        $total_order = Order::count();
        $total_user = User::where('role', 3)->count();
        return view(
            'client.dashboard',
            [
                'categories' => $categories,
                'dashboard_data' => [
                    [
                        'total' => $categories->count(),
                        'title' => "Total Categories",
                        'link' => "category",
                        'icon' => 'tasks',
                        'color'=>'green'

                    ],
                    [
                        'total' => $your_categ,
                        'title' => "Your Categories",
                        'link' => "category",
                        'icon' => 'user-plus',
                        'color'=>'yellow'


                    ],
                    [
                        'total' => $product_count,
                        'title' => "Total Products",
                        'link' => "products",
                        'icon' => 'product-hunt',
                        'color'=>'pink'


                    ],
                    [
                        'total' => $your_prod,
                        'title' => "Your Products",
                        'link' => "products",
                        'icon' => 'user-circle',
                        'color'=>'blue'


                    ],
                    [
                        'total' => $total_order,
                        'title' => "Total Orders",
                        'link' => "merchant.orders",
                        'icon' => 'shopping-bag',
                        'color'=>'green'


                    ],
                    [
                        'total' => $total_user,
                        'title' => "Total Customer",
                        'link' => "users",
                        'icon' => 'user',
                        'color'=>'green-yellow'


                    ]
                ]
            ]
        );
    }
}

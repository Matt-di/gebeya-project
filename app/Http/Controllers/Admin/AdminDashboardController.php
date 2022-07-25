<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
    
        $total_categories = Category::count();
        $total_users = User::count();
        $total_products = Product::count();
        $total_order = Order::count();
        $total_user = User::count();
        $total_client = User::where('role', 1)->count();
        return view(
            'admin.dashboard',
            [
                'dashboard_data' => [
                    [
                        'total' => $total_categories,
                        'title' => "Total Categories",
                        'link' => "category",
                        'icon' => 'tasks',
                        'color'=>'green'
                    ],
                    [
                        'total' => $total_user,
                        'title' => "Store Users",
                        'link' => "users",
                        'icon' => 'user-plus',
                        'color'=>'yellow'

                    ],
                    [
                        'total' => $total_products,
                        'title' => "Total Products",
                        'link' => "products",
                        'icon' => 'product-hunt',
                        'color'=>'pink'

                    ],
                    [
                        'total' => $total_order,
                        'title' => "Total Order",
                        'link' => "products",
                        'icon' => 'user-circle',
                        'color'=>'blue'


                    ],
                    [
                        'total' =>  $total_client,
                        'title' => "Total Client",
                        'link' => "order",
                        'icon' => 'shopping-bag',
                        'color'=>'green'


                    ],
                    [
                        'total' => $total_users,
                        'title' => "Total Sytem Users",
                        'link' => "users",
                        'icon' => 'user',
                        'color'=>'green-yellow'

                    ]
                ]
            ]
        );
    }
}

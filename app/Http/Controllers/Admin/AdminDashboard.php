<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminDashboard extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:web_admin');
    }
    public function index()
    {
        // dd(auth()->user()->categories);
        $total_categories = Category::count();
        $total_users = User::count();
        $total_products = Product::count();
        $total_order = Order::count();
        $total_user = User::where('user_type', 'merchant')->count();
        $total_client = User::where('user_type', 'client')->count();
        return view(
            'admin.dashboard',
            [
                'dashboard_data' => [
                    [
                        'total' =>$total_categories,
                        'title' => "Total Categories",
                        'link' => "category",
                        'icon' => 'tasks'
                    ],
                    [
                        'total' =>$total_user,
                        'title' => "Store Users",
                        'link' => "users",
                        'icon' => 'user-plus'

                    ],
                    [
                        'total' => $total_products,
                        'title' => "Total Products",
                        'link' => "products",
                        'icon' => 'product-hunt'

                    ],
                    [
                        'total' => $total_order,
                        'title' => "Total Order",
                        'link' => "products",
                        'icon' => 'user-circle'

                    ],
                    [
                        'total' =>  $total_client,
                        'title' => "Total Client",
                        'link' => "order",
                        'icon' => 'shopping-bag'

                    ],
                    [
                        'total' => $total_users,
                        'title' => "Total Sytem Users",
                        'link' => "users",
                        'icon' => 'user'

                    ]
                ]
            ]
        );
    }
}

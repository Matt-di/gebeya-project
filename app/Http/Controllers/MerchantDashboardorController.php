<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class MerchantDashboardorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        $categories = Category::get();
        $your_categ = auth()->user()->categories()->count();
        $product_count = Product::count();
        $your_prod = auth()->user()->products()->count();

        $total_order = Order::count();
        $total_user = User::where('user_type', 'client')->count();
        return view(
            'client.dashboard',
            [
                'categories' => $categories,
                'dashboard_data' => [
                    [
                        'total' => $categories->count(),
                        'title' => "Total Categories",
                        'link' => "category",
                        'icon' => 'tasks'
                    ],
                    [
                        'total' => $your_categ,
                        'title' => "Your Categories",
                        'link' => "category",
                        'icon' => 'user-plus'

                    ],
                    [
                        'total' => $product_count,
                        'title' => "Total Products",
                        'link' => "products",
                        'icon' => 'product-hunt'

                    ],
                    [
                        'total' => $your_prod,
                        'title' => "Your Products",
                        'link' => "products",
                        'icon' => 'user-circle'

                    ],
                    [
                        'total' => $total_order,
                        'title' => "Total Orders",
                        'link' => "merchant.orders",
                        'icon' => 'shopping-bag'

                    ],
                    [
                        'total' => $total_user,
                        'title' => "Total Customer",
                        'link' => "users",
                        'icon' => 'user'

                    ]
                ]
            ]
        );
    }
}

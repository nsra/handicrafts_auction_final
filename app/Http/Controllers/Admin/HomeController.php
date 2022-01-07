<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use APP\Models\User;
use APP\Models\Product;
use APP\Models\Bid;
use APP\Models\Category;
use APP\Models\Role;
use APP\Models\Order;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }


    public function adminDashboard()
    {
        $orders = Order::where([])->count();
        $products = Product::where([])->count();
        $roles = Role::where([])->count();
        $bids = Bid::where([])->count();
        $categories = Category::where([])->count();
        $buyers = User::where([['role_id', '=', '3'], ['is_delete','=', 0]])->count();
        $craftsmen = User::where([['role_id', '=', '2'], ['is_delete','=', 0]])->count();
        return view('base_layout.admin_dashboard', compact('products', 'craftsmen', 'buyers', 'orders', 'roles', 'bids', 'categories'));
    }
}

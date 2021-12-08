<?php

namespace App\Http\Controllers\Craftsman;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('craftsman');
    }

    public function craftsmanDashboard()
    {

        $authUserOrderedProducts = Product::where([['user_id', '=', auth()->user()->id], ['is_delete', '=', 1]])->count();
        $authUserWinedAuctions = Order::where('user_id', '=', auth()->user()->id)->count();
        $products = Product::where('is_delete', '=', 0)->orderBy('id', 'DESC')->paginate(8);
        $categories = Category::get();
        return view('app.index', compact('products', 'categories', 'authUserOrderedProducts', 'authUserWinedAuctions'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('app.craftsman.profile', compact('user'));
    }
}

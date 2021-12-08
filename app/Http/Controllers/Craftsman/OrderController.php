<?php

namespace App\Http\Controllers\Craftsman;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('craftsman');
    }

    public function index(Request $request)
    {
        $products = Product::where('user_id', auth()->user()->id);
        $search_item = $request->input('name');
        if ($request->has('name')) {
            $products =  $products->where(function ($query) use ($search_item) {
                $query->where('title', 'like', "%{$search_item}%");
            });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        $user = Auth::user();
        return view('app.craftsman.ordered_products', compact('user', 'products'));
    }

    public function view_buyer($id)
    {
        $user = Order::findOrFail($id)->user;
        $product = Order::findOrFail($id)->product;
        return view('app.craftsman.product_bid_buyer', compact('user', 'product'));
    }
}

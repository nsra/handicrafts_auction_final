<?php

namespace App\Http\Controllers\Buyer;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Bid;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('buyer');
    }

    public function index(Request $request)
    {
        $products = Product::where([['user_id', '=', Auth::user()->id], ['is_delete', '=', 0]]);
        $search_item = $request->input('name');
        if ($request->has('name')) {
            $products = $products->where(function ($query) use ($search_item) {
                $query->where('title', 'like', "%{$search_item}%")
                    ->orWhere('orderNowPrice', 'like', "%{$search_item}%");
            });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        $user = Auth::user();
        return view('app.craftsman.products', compact('user', 'products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $buyer = auth()->user()->id;
        $categories = Category::All();
        return view('app.buyer.bid_product', compact('product', 'categories', 'buyer'));
    }


    public function view_product_bids($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $search_item = $request->input('name');
        $craftsman = $product->user;
        $bids = Bid::where('product_id', '=', $product->id);
        if ($request->has('name')) {
            $bids = $bids->where(function ($query) use ($search_item) {
                $query->where('price', 'like', "%{$search_item}%")
                    ->orWhere('description', 'like', "%{$search_item}%");
            });
        }
        $bids = $bids->orderBy('id', 'DESC')->paginate(6);
        return view('app.buyer.product_bids', compact('bids', 'product', 'craftsman'));
    }

    public function view_craftsman($id)
    {
        $user = User::findOrFail($id);
        return view('app.buyer.product_craftsman', compact('user'));
    }

    public function view_craftsman_products($id, Request $request)
    {
        $user = Product::findOrFail($id)->user;
        $search_item = $request->input('name');
        $products = Product::where([['user_id', '=', $user->id], ['is_delete', '=', 0]]);
        if ($request->has('name')) {
            $products = $products->where(function ($query) use ($search_item) {
                $query->where('title', 'like', "%{$search_item}%")
                    ->orWhere('description', 'like', "%{$search_item}%")
                    ->orWhere('price', 'like', "%{$search_item}%");
            });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        return view('app.buyer.craftsman_products', compact('user', 'products'));
    }

    public function view_buyer($id)
    {
        $user = Bid::findOrFail($id)->user;
        $product = Bid::findOrFail($id)->product;
        return view('app.buyer.product_bid_buyer', compact('user', 'product'));
    }
}

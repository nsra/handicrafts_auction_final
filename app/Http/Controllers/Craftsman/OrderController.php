<?php

namespace App\Http\Controllers\Craftsman;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use App\Models\Product;
use App\Models\Role;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\PseudoTypes\True_;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('craftsman');
    }

    public function index($id, Request $request)
    {
        $products = Product::where([]);
        $search_item= $request->input('name');
        if ($request->has('name')){
            $products = Order::join('products', 'orders.product_id', '=', 'products.id');
            $products = $products->where(function ($query) use ($search_item) {
                           $query->where('title', 'like', "%{$search_item}%")
                                 ->orWhere('orderNowPrice', 'like', "%{$search_item}%");
                       });
        }
        $products = $products->where([])->paginate(6);
        $user= Auth::user();
        return view('app.craftsman.ordered_products', compact('user', 'products'));
    }

  
}

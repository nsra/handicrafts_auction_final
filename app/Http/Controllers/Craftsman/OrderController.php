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

    public function index(Request $request)
    {
        $products = Product::where('user_id', auth()->user()->id);
        $search_item= $request->input('name');
        if ($request->has('name')){
            $products =  $products->where(function ($query) use ($search_item) {
                           $query->where('title', 'like', "%{$search_item}%");
            });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        $user= Auth::user();
        return view('app.craftsman.ordered_products', compact('user', 'products'));
    }

    public function view_buyer($id){
        $user= Order::findOrFail($id)->user;
        $product= Order::findOrFail($id)->product;
        return view('app.craftsman.product_bid_buyer', compact('user', 'product'));
    }
}

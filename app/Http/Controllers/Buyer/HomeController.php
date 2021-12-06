<?php

namespace App\Http\Controllers\Buyer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('buyer');
    }

    public function buyerDashboard()
    {
       
        $authUserOrderedProducts= Product::where([['user_id', '=', auth()->user()->id], ['is_delete', '=', 1]])->count();
        $authUserWinedAuctions= Order::where('user_id', '=', auth()->user()->id)->count();
    
        // dd($authUserOrderedProducts, $authUserWinedAuctions);
        
        $products= Product::where('is_delete', '=', 0)->orderBy('id', 'DESC')->paginate(8);
        $categories= Category::where([]);
        return view('app.index', compact('products', 'categories', 'authUserOrderedProducts', 'authUserWinedAuctions'));
    }

    public function profile()
    {
        $user= Auth::user();
        return view('app.buyer.profile', compact('user'));
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use App\Models\Bid;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   
    public function __construct()
    {

    }

  
    public function home()
    {
        $user_role="";
        $categories= Category::get();
        $products= Product::where('is_delete', '=', 0)->orderBy('id', 'DESC')->paginate(8);
        if(Auth::user()) $user_role=Auth::user()->role->name;
        if ($user_role === "Admin") {
            return redirect()->route('admin_dashboard');
        }
        else if($user_role === "Craftsman"){
            return redirect()->route('craftsman_dashboard');
        }
        else return view('app.index', compact('products', 'categories'));
    }

    public function index(Request $request)
    {
        $products= Product::where('is_delete', '=', 0);
     
        if ($request->has('title'))
            $products = $products->where('title', 'like', "%{$request->input('title')}%");

        if ($request->category != null)
            $products = $products->where('category_id', '=', $request->input('category'));

        if ($request->lowPrice != null)
            $products = $products->where('orderNowPrice', '>=', $request->input('lowPrice'));
        
        if ($request->highPrice != null)
            $products = $products->where('orderNowPrice', '<=', $request->input('highPrice'));
        
        $products = $products->orderBy('id', 'DESC')->paginate(8);
        $categories= Category::get();
        return view('app.index', compact('products', 'categories'));
    }

    public function category_products(Request $request, $id)
    {

        $category= Category::findOrFail($id);
        $products= Product::where([['category_id', '=', $category->id],['is_delete', '=', 0]]);

        if ($request->has('title'))
        $products = $products->where('title', 'like', "%{$request->input('title')}%");

        if ($request->lowPrice != null)
            $products = $products->where('orderNowPrice', '>=', $request->input('lowPrice'));
        
        if ($request->highPrice != null)
            $products = $products->where('orderNowPrice', '<=', $request->input('highPrice'));
        
        $products = $products->orderBy('id', 'DESC')->paginate(8);
        return view('app.category_products', compact('category', 'products'));
    }

    public function product_details($id)
    {
        
        $categories= Category::get();
        $product= Product::findOrFail($id);
        // dd($product->is_delete);
        $bids = Bid::where('product_id', '=', $product->id)->orderBy('id', 'DESC')->paginate(8);
        return view('app.product_details', compact('categories', 'product', 'bids'));
    }

    public function view_craftsman($id){
        $product= Product::findOrFail($id);
        $user= $product->user;
        return view('app.product_craftsman', compact('user', 'product'));
    }

    public function view_craftsman_products($id, Request $request){
        $user= Product::findOrFail($id)->user;
        $search_item= $request->input('name');
        // $products= $user->products;
        $products= Product::where([['user_id', '=', $user->id], ['is_delete', '=', 0]]);
        if ($request->has('name')){
            $products = $products->where(function ($query) use ($search_item) {
                           $query->where('title', 'like', "%{$search_item}%")
                                 ->orWhere('description', 'like', "%{$search_item}%")
                                 ->orWhere('price', 'like', "%{$search_item}%");
                       });
        }
        $products=$products->orderBy('id', 'DESC')->paginate(6);
        return view('app.craftsman_products', compact('user', 'products'));
    }

    public function view_buyer($id){
        $user= Bid::findOrFail($id)->user;
        $product= Bid::findOrFail($id)->product;
        return view('app.product_bid_buyer', compact('user', 'product'));
    }

    public function about_us(){
        return view('app.about_us');
    }
    
}

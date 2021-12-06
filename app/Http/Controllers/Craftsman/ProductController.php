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

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('craftsman');
    }

    public function index(Request $request)
    {
        $products = Product::where('user_id', '=', Auth::user()->id);
        $search_item= $request->input('name');
        if ($request->has('name')){
            $products = $products->where(function ($query) use ($search_item) {
                           $query->where('title', 'like', "%{$search_item}%")
                                 ->orWhere('orderNowPrice', 'like', "%{$search_item}%");
                       });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        $user= Auth::user();
        return view('app.craftsman.products', compact('user', 'products'));
    }

    public function auctioned_products(Request $request)
    {
        $products = Product::where('user_id', '=', Auth::user()->id);
        $search_item= $request->input('name');
        if ($request->has('name')){
            $products = $products->where(function ($query) use ($search_item) {
                           $query->where('title', 'like', "%{$search_item}%")
                                 ->orWhere('orderNowPrice', 'like', "%{$search_item}%");
                       });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        $user= Auth::user();
        return view('app.craftsman.auctioned_products', compact('user', 'products'));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        if($product->user_id != Auth::user()->id)
            return redirect()->back()->with('error', 'You cant handle other craftsmen products!');
        $craftsman= $product->user;
        $categories= Category::All();
        return view('app.craftsman.edit_product', compact('product', 'categories', 'craftsman'));
    }

    public function update($id, Request $request){
        try{
            $product = Product::findOrFail($id);
            $this->validate($request, [
                'title' => ['required', 'string', 'max:50', 'unique:products,title,'.$id],
                'description' => ['required', 'string'],
                'orderNowPrice' => ['required', 'numeric'],
            ]);
            $product->fill($request->all());
            $product->update();
            return redirect()->back()->with('success', 'product updated successfully');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'update product faild');
        }
    }

    public function create(){
        $categories= Category::All();
        $craftsman= Auth::user();
        return view('app.craftsman.create_product', compact('categories', 'craftsman'));
    }

    public function store(Request $request){
        try{
            $this->validate($request, [
                'title' => ['required', 'string', 'max:50', 'unique:products'],
                'description' => ['required', 'string'],
                'orderNowPrice' => ['required', 'numeric'],
            ]);
            $product= Product::create([
                'title' => $request['firstName'],
                'description' => $request['email'],
                'category_id' => $request['category_id'],
                'orderNowPrice' => $request['orderNowPrice'],
                'is_delete' => 0,
            ]);
            $product->user_id = Auth::user()->id;
            if ($product->save() === TRUE)
            return redirect()->back()->with('success', 'product created successfully');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'create product faild');
        }
    }

    public function view_product_bids($id, Request $request)
    {
        $product= Product::findOrFail($id);
        $search_item= $request->input('name');
        $craftsman= $product->user;
        $bids= Bid::where('product_id', '=', $id);
        if ($request->has('name')){
            $bids = $bids->where(function ($query) use ($search_item) {
                           $query->where('price', 'like', "%{$search_item}%")
                                 ->orWhere('description', 'like', "%{$search_item}%");
                       });
        }
        $bids=$bids->orderBy('id', 'DESC')->paginate(6);
        return view('app.craftsman.product_bids', compact('bids', 'product', 'craftsman'));
    }

    public function view_buyer($id){
        $user= Bid::findOrFail($id)->user;
        $product= Bid::findOrFail($id)->product;
        return view('app.craftsman.product_bid_buyer', compact('user', 'product'));
    }

    public function destroy($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('craftsman.products')->with('success', 'product deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->route('craftsman.products')->with('error', 'fail to delete product');
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        return view('app.craftsman.delete', compact('product'));
    }

    public function destroy_out($id)
    {
        try {
            $product = Product::find($id);
            $product->delete();
            return redirect()->route('index')->with('success', 'product deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'fail to delete product');
        }
    }

    public function delete_out($id)
    {
        $product = Product::find($id);
        return view('app.craftsman.delete_out', compact('product'));
    }

    public function view_buyer_bids(Request $request, $id){
        $user= Bid::findOrFail($id)->user;
        $bids= $user->bids;
        return view('app.craftsman.buyer_bids', compact('user', 'bids'));
    }

    public function extend_auction(Request $request, $id){
        $days = $request->days;
        if($days > 15 || $days < 1)
            return redirect()->back()->with('error', 'extending auction faild!, days should be from 1 to 15');
        else {
            $product = Product::findOrFail($id);
            $product->end_auction = $product->end_auction->addDays($days);
            $product->save();
            return redirect()->back()->with('success', 'auction extended till'.$product->end_auction->toDateString());
        }
    }
}



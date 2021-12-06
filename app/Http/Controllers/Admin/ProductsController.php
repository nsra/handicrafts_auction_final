<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Bid;
use App\Models\Product;
use Exception;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $products = Product::where([]);
        $search_item= $request->input('name');
        if ($request->has('name')){
            $buyers = $products->where(function ($query) use ($search_item) {
                           $query->where('title', 'like', "%{$search_item}%")
                                 ->orWhere('orderNowPrice', 'like', "%{$search_item}%");
                       });
        }
        if ($request->category != null)
            $products = $products->where('category_id', '=', $request->input('category'));
        
        $products = $products->orderBy('id', 'DESC')->paginate(5);
        $categories = Category::get();
        return view('admin.products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.products.show', [
            'product' => Product::findOrFail($id),
            'categories' => Category::get()
        ]);
    }

    public function bids($id, Request $request)
    {
        $product= Product::findOrFail($id);
        $bids= Bid::where('product_id', '=', $product->id);
        $search_item= $request->input('name');
        if ($request->has('name')){
            $bids = $bids->where(function ($query) use ($search_item) {
                           $query->where('price', 'like', "%{$search_item}%")
                                 ->orWhere('description', 'like', "%{$search_item}%");
                       });
        }
        $bids=$bids->orderBy('id', 'DESC')->paginate(6);
        return view('admin.products.bids', compact('product', 'bids'));
    }

    public function view_product_bid_buyer($id)
    {
        $bid= Bid::findOrFail($id);
        $product=$bid->product;
        $buyer= $bid->user;
        return view('admin.products.product_bid_buyer', compact('bid', 'product', 'buyer'));
    }

    public function view_product_craftsman($id)
    {
        $product= Product::findOrFail($id);
        $craftsman= $product->user;
        return view('admin.products.product_craftsman', compact('craftsman', 'product'));
    }
  

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if($product->bids->count() > 0) $product->bids()->delete();
            $product->delete();
            return redirect()->back()->with('success', 'product with related bids deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'fail to delete product');
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        return view('admin.products.delete', compact('product'));
    }
}

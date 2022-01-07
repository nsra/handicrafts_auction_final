<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\User;
use App\Models\Bid;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CraftsmenController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request)
    {
        $craftsmen = User::where([['role_id', '=', '2'], ['is_delete','=', 0]]);
        $search_item = $request->input('name');
        if ($request->has('name')) {
            $craftsmen = $craftsmen->where(function ($query) use ($search_item) {
                $query->where('firstName', 'like', "%{$search_item}%")
                    ->orWhere('lastName', 'like', "%{$search_item}%")
                    ->orWhere('username', 'like', "%{$search_item}%")
                    ->orWhere('email', 'like', "%{$search_item}%");
            });
        }
        $craftsmen = $craftsmen->orderBy('id', 'DESC')->paginate(6);
        return view('admin.craftsmen.index', compact('craftsmen'));
    }


    public function show($id)
    {
        return view('admin.craftsmen.show', [
            'craftsman' => User::findOrFail($id),
        ]);
    }

    public function products($id, Request $request)
    {
        $craftsman = User::findOrFail($id);
        $products = Product::where('user_id', '=', $craftsman->id);
        $search_item = $request->input('name');
        if ($request->has('name')) {
            $products = $products->where(function ($query) use ($search_item) {
                $query->where('orderNowPrice', 'like', "%{$search_item}%")
                    ->orWhere('title', 'like', "%{$search_item}%")
                    ->orWhere('description', 'like', "%{$search_item}%");
            });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        return view('admin.craftsmen.products', compact('craftsman', 'products'));
    }

    public function view_craftsman_product($id)
    {
        $product = Product::findOrFail($id);
        $craftsman = $product->user;
        return view('admin.craftsmen.craftsman_product', compact('product', 'craftsman'));
    }

    public function view_product_bids($id, Request $request)
    {
        $product = Product::findOrFail($id);
        $search_item = $request->input('name');
        $craftsman = $product->user;
        $bids = Bid::where('product_id', '=', $id);
        if ($request->has('name')) {
            $bids = $bids->where(function ($query) use ($search_item) {
                $query->where('price', 'like', "%{$search_item}%")
                    ->orWhere('description', 'like', "%{$search_item}%");
            });
        }
        $bids = $bids->orderBy('id', 'DESC')->paginate(6);
        return view('admin.craftsmen.bid_product_craftsman', compact('bids', 'product', 'craftsman'));
    }

    public function destroy($id)
    {
        try {
            $craftsman = User::findOrFail($id);
            if ($craftsman->products->count() > 0) $craftsman->products()->delete();
            $craftsman->is_delete= 1;
            $craftsman->update();
            return redirect()->back()->with('success', 'craftsman deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'fail to delete craftsman');
        }
    }

    public function delete($id)
    {
        $craftsman = User::find($id);
        return view('admin.craftsmen.delete', compact('craftsman'));
    }
}

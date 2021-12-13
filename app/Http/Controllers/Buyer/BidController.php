<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Bid;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('buyer');
    }

    public function index(Request $request)
    {
        $bids = Bid::where('user_id', Auth::user()->id);
        $search_item = $request->input('name');
        if ($request->has('name')) {
            $bids = $bids->where(function ($query) use ($search_item) {
                $query->where('price', 'like', "%{$search_item}%");
            });
        }
        $bids = $bids->orderBy('id', 'DESC')->paginate(6);
        $user = Auth::user();
        return view('app.buyer.bids', compact('user', 'bids'));
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
        return view('app.craftsman.product_bids', compact('bids', 'product', 'craftsman'));
    }

    public function view_buyer($id)
    {
        $user = Bid::findOrFail($id)->user;
        $product = Bid::findOrFail($id)->product;
        return view('app.craftsman.product_bid_buyer', compact('user', 'product'));
    }

    public function destroy($id)
    {
        try {
            $bid = Bid::findOrFail($id);
            $product = $bid->product;
            if ($product->isOrderedByMy())
                return redirect()->back()->with('error', 'you ordered this product');
            $bid->delete();
            return redirect()->back()->with('success', 'bid deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'fail to delete bid');
        }
    }

    public function delete($id)
    {
        $bid = Bid::find($id);
        return view('app.buyer.delete', compact('bid'));
    }

    public function place_bid($id)
    {
        $categories = Category::get();
        $product = Product::findOrFail($id);
        $bids = Bid::where('product_id', '=', $id)->orderBy('id', 'DESC')->paginate(8);
        return view('app.buyer.place_bid', compact('categories', 'product', 'bids'));
    }

    public function stor_place_bid($id, Request $request)
    {
        try {
            $product = Product::findOrFail($id);

            if ($product->authUserBidId() > 0)
                return redirect()->back()->with('error', 'You have already bid on this product');

            $min = $product->isAuctioned() ? $product->startingBidPrice(): $product->maxBidPrice() + $product->bidIncreament();
            $this->validate($request, [
                'price' => 'required|numeric|min:' . $min,
                'description' => ['required', 'string'],
            ]);
            $bid = Bid::create([
                'price' => $request['price'],
                'description' => $request['description'],
                'user_id' => auth()->user()->id,
                'product_id' => $id,
            ]);
            $bid->user_id = Auth::user()->id;
            if ($bid->save() === TRUE)
                return redirect()->back()->with('success', 'bid added successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'bidding faild!');
        }
    }
}

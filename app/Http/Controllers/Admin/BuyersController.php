<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bid;
use App\Models\Product;
use Exception;

class BuyersController extends Controller
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
        $buyers = User::where('role_id', '=', '3');
        $search_item= $request->input('name');
        if ($request->has('name')){
            $buyers = $buyers->where(function ($query) use ($search_item) {
                           $query->where('firstName', 'like', "%{$search_item}%")
                                 ->orWhere('lastName', 'like', "%{$search_item}%")
                                 ->orWhere('username', 'like', "%{$search_item}%")
                                 ->orWhere('email', 'like', "%{$search_item}%");
                       });
        }
        $buyers = $buyers->where([])->paginate(6);
        return view('admin.buyers.index', compact('buyers'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.buyers.show', [
            'buyer' => User::find($id),
        ]);
    }

    public function bids($id, Request $request)
    {
        $buyer= User::find($id);
        $bids= Bid::where('user_id', '=', $buyer->id);
        $search_item= $request->input('name');
        if ($request->has('name')){
            $bids = $bids->where(function ($query) use ($search_item) {
                           $query->where('price', 'like', "%{$search_item}%")
                                 ->orWhere('description', 'like', "%{$search_item}%");
                       });
        }
        $bids=$bids->where([])->paginate(6);
        return view('admin.buyers.bids', compact('buyer', 'bids'));
    }

    public function view_bid_product($id)
    {
        $bid= Bid::find($id);
        $product=$bid->product;
        $buyer= $bid->user;
        return view('admin.buyers.bid_product', compact('bid', 'product', 'buyer'));
    }

    public function view_bid_product_craftsman($id)
    {
        $product= Product::find($id);
        $craftsman= $product->user;
        return view('admin.buyers.bid_product_craftsman', compact('craftsman', 'product'));
    }
  
    public function destroy($id)
    {
        try {
            $buyer = User::find($id);
            if($buyer->bids()->count !== 0) $buyer->bids()->delete();
            $buyer->delete();
            return redirect()->back()->with('success', 'buyer with his bids deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'fail to delete buyer');
        }
    }
}

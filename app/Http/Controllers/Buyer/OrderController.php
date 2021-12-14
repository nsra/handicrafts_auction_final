<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Bid;
use App\Models\Category;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('buyer');
    }

    public function index(Request $request)
    {
        $products = Product::where([]);
        $search_item = $request->input('name');
        if ($request->has('name')) {
            $products =  $products->where(function ($query) use ($search_item) {
                $query->where('title', 'like', "%{$search_item}%");
            });
        }
        $products = $products->orderBy('id', 'DESC')->paginate(6);
        $user = Auth::user();
        return view('app.buyer.ordered_products', compact('user', 'products'));
    }

    public function delete($id)
    {
        $order = Order::find($id);
        return view('app.buyer.deliver', compact('order'));
    }


    public function destroy($id)
    {
        try {
            $ordered_product_id = Order::findOrFail($id)->product->id;
            $product = Product::findOrFail($ordered_product_id);
            $product->bids()->delete();
            $product->delete();
            Order::findOrFail($id)->delete();
            return redirect()->back()->with('success', 'delivary confirmed, your completed order has been removed');
        } catch (Exception $e) {
            return redirect()->back()->with('success', 'delivary confirmed, your order has been removed');
        }
    }


    public function view_craftsman($id)
    {

        $product = Order::findOrFail($id)->product;
        $user = $product->user;
        return view('app.buyer.product_craftsman', compact('user', 'product'));
    }

    public function order_now($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);
        $categories = Category::get();
        $bids = Bid::where('product_id', '=', $id)->orderBy('id', 'DESC')->paginate(8);
        return view('app.buyer.order_now', compact('user', 'product', 'bids'));
    }

    public function store_order_now($id)
    {
        $product = Product::findOrFail($id);
        if ($product->not_ordered()) {
            $order = Order::create([
                'price' => $product->orderNowPrice,
                'is_ordered_by_auction' => 0,
                'user_id' => auth()->user()->id,
                'product_id' => $product->id,
                'created_at' => Carbon::now()
            ]);
            if ($order->save() === TRUE) {
                $product->is_delete = 1;
                $product->update();
                $user = Auth::user();
                $craftsman = $product->user;
                Mail::raw("Congrats 🎉, Your order: << " . $product->title . " >> will deliver within 3 hours, \n \n Please confirm the receipt from Your Orders Panel immediately as you receive your product: \n".route('buyer.ordered_products'), function ($mail) use ($user) {
                    $mail->from('laraveldemo2018@gmail.com', 'Handicrafts Auction');
                    $mail->to($user->email)
                        ->subject('Your Order Is On Delivary...');
                });
                Mail::raw("Congrats 🎉, Your product: << " . $product->title . " >> has been ordered by " . $user->username . " You have 3 hours to deliver it to him, \n \n Please chech Your Ordered Products Panel to get the buyer address: \n ".route('craftsman.ordered_products'). "\n When you deliver buyer the product ask him to confirm the product delivery from the website immediately as he received it.", function ($mail) use ($craftsman) {
                    $mail->from('laraveldemo2018@gmail.com', 'Handicrafts Auction');
                    $mail->to($craftsman->email)
                        ->subject('You Have New Ordered Product');
                });
                return redirect()->back()->with('success', 'Congrats 🎉, Your order: << ' . $product->title . ' >> will deliver within 3 hours, please confirm the receipt from Your Orders Panel immediately as you receive your product.');
            }
        } else return redirect()->back()->with('error', 'orderring faild!, product is locked!');
    }
}

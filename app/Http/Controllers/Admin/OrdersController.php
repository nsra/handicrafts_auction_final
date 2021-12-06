<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;
use App\Models\Bid;
use App\Models\Product;
use Exception;

class OrdersController extends Controller
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
        $orders = Order::where('is_delivered', '=', 0)->orderBy('id', 'DESC')->paginate(6);
        return view('admin.orders.index', compact('orders'));
    }

    public function view_order($id)
    {
        $product= Order::findOrFail($id)->product;
        $bids= Bid::where('product_id', '=', $product->id)->orderBy('id', 'DESC')->paginate(6);
        $craftsman=$product->user;
        $buyer= Order::findOrFail($id)->user;
        return view('admin.orders.show', compact('product', 'bids', 'craftsman', 'buyer'));
    }


    // public function destroy($id)
    // {
    //     try {
    //         $order = Order::findOrFail($id);
    //         $order->delete();
    //         //product->isdelete = 0
    //         return redirect()->back()->with('success', 'order deleted successfuly');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'fail to delete order');
    //     }
    // }
    public function destroy($id)
    {
        try {
            $order =  Order::findOrFail($id);
            $product= Order::findOrFail($id)->product;
            $product->is_delete= 0;
            $product->update();
            $order->delete();
            return redirect()->back()->with('success', 'order deleted successfuly');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'fail to delete order');
        }
    }
    
    public function delete($id)
    {
        $order = Order::find($id);
        return view('admin.orders.delete', compact('order'));
    }
}

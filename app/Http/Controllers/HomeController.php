<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $user_role="";
        $products= Product::where([])->paginate(8);
        if(Auth::user()) $user_role=Auth::user()->role->name;
        if ($user_role === "Admin") {
            return redirect()->route('admin_dashboard');
        }
        else if($user_role === "Craftsman"){
            return redirect()->route('craftsman_dashboard');
        }
        else return view('app.index', compact('products'));
    }

    public function index()
    {
        $products= Product::where([])->paginate(8);
        return view('app.index', compact('products'));
    }

    public function category_products($id)
    {
        $category= Category::find($id);
        $products= $category->products;//pagination not working
        return view('app.category_products', compact('category', 'products'));
    }

}

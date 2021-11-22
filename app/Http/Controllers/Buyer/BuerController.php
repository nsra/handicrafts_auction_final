<?php

namespace App\Http\Controllers\Buyer;
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

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('buyer');
    }

    public function edit_buyer_profile(){
        $user= Auth::user();
        return view('app.buyer.profile', compact('user'));
    }

    public function update_buyer_profile(Request $request){
        try{
            $buyer = User::findOrFail(Auth::user()->id);
            $id=$buyer->id;
            $this->validate($request, [
                'firstName' => ['required', 'string', 'max:20'],
                'lastName' => ['required', 'string', 'max:20'],
                'username' => ['required', 'string', 'max:20', 'unique:users,username,'.$id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
                'address' => ['required', 'string'],
                'mobile' => ['required', 'numeric', 'digits:10'],
            ]);
            $buyer->fill($request->all());
            $buyer->update();
            return redirect()->back()->with('success', 'profile updated successfully');
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'update profile faild');
        }
    }

    public function change_buyer_password(){
        $user= Auth::user();
        return view('app.buyer.changepassword', compact('user'));
    }

    public function update_buyer_password(Request $request){
        $this->validate($request, [
            'current_password' => ['required'],
            'password' => ['required','string','min:8','confirmed'],
            'password_confirmation' => ['required'],
        ]);
        
        $user = User::find(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password does not correct!');
        }
        $user->password = Hash::make($request->password);
        if($user->save() === True)
            return back()->with('success', 'Password successfully changed!');
        else return back()->with('error', 'change password faild!');
    }
}

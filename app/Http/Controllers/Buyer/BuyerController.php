<?php

namespace App\Http\Controllers\Buyer;

use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BuyerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('buyer');
    }

    public function edit_buyer_profile()
    {
        $user = Auth::user();
        return view('app.buyer.profile', compact('user'));
    }

    public function product()
    {
        $user = Auth::user();
        return view('app.buyer.place_bid', compact('user'));
    }

    public function update_buyer_profile(Request $request)
    {
        $buyer = User::findOrFail(Auth::user()->id);
        $id = $buyer->id;
        $this->validate($request, [
            'firstName' => ['required', 'string', 'max:20'],
            'lastName' => ['required', 'string', 'max:20'],
            'username' => ['required', 'string', 'max:20', 'unique:users,username,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'address' => ['required', 'string'],
            'mobile' => ['required', 'numeric', 'digits:10', 'unique:users,mobile,' . $id],
        ]);
        $buyer->fill($request->all());

        if($buyer->update() === True)
            return redirect()->back()->with('success', 'profile updated successfully');
        else
            return redirect()->back()->with('error', 'update profile faild');
    }

  
    public function edit_image($id)
    {
        $user = User::find($id);
        return view('app.buyer.edit', compact('user'));
    }

    public function update_image($id, Request $request)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'image' => ['image'],
        ]);

        if ($request->hasfile('image')) {
            // if(str_replace("/storage/uploads/", "",$user->image)!= 'n0_image.PNG')
            //     Storage::delete('public/uploads/' . str_replace("/storage/uploads/", "",$user->image));
            $image = $request->file('image');
            $name = $image->getClientOriginalName();
            $path = $image->storeAs('uploads', $name, 'public');
            $user->image = '/storage/' . $path;
        }
        if($user->update()=== True)
            return redirect()->back()->with('success', 'image updated successfully');
        else
            return redirect()->back()->with('error', 'update image failed');
    }

    public function change_buyer_password()
    {
        $user = Auth::user();
        return view('app.buyer.changepassword', compact('user'));
    }

    public function update_buyer_password(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        $user = User::findOrFail(Auth::user()->id);
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is not correct!');
        }
        $user->password = Hash::make($request->password);
        if ($user->save() === True)
            return back()->with('success', 'Password successfully changed!');
        else 
            return back()->with('error', 'change password faild!');
    }
}

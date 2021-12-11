<?php

namespace App\Models;

use App\Models\User;
use App\Models\Bid;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'title',
        'description',
        'category_id',
        'orderNowPrice',
        'is-ordered-by-auction',
        'is_delete'
    ];

    protected $dates = ['start_auction', 'end_auction', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function getImage()
    {
        if (!$this->images->first())
            return asset('no_image.png');
        return asset($this->image);
    }

    public function startingBidPrice()
    {
        return ceil($this->orderNowPrice * (40 / 100));
    }

    public function bidIncreament()
    {
        return ceil($this->orderNowPrice * (6 / 100));
    }

    public function maxBidPrice()
    {
        return $this->bids->max('price');
    }

    public function isAuctioned()
    {
        return $this->bids->count() > 0  ?  true : false;
    }

    public function isOrdered()
    {
        $orders = Order::where('product_id', '=', $this->id)->get()->count();
        return $orders == 1 ? true : false;
    }

    public function isOrderedByMy()
    {
        $orders = Order::where([['product_id', '=', $this->id], ['user_id', '=', auth()->user()->id]])->count();
        return $orders > 0 ? true : false;
    }

    public function isExpired()
    {
        $start = $this->start_auction;
        $end = $this->end_auction;
        $totalDuration = $start->diffInSeconds($end);
        $now = Carbon::now();
        $passed = $start->diffInSeconds($now);
        return $passed >= $totalDuration ? true : false;
    }

    public function remainingTime()
    {
        return $this->isExpired() ? 0 : $this->end_auction->diffInSeconds(Carbon::now());
    }

    public function authUserBidId()
    {
        return $this->bids->contains('user_id', Auth::user()->id) ? Bid::where([['product_id', '=', $this->id], ['user_id', '=', Auth::user()->id]])->first()->id : 0 ;
    }

    public function maxBidder()
    {
        return Bid::where('price', '=', $this->maxBidPrice())->first()->user;
    }

    public function not_ordered()
    {
        return Order::where('product_id', '=', $this->id)->count() == 0 ? true : false;
    }

    public function order_by_auction()
    {
        if ($this->not_ordered() && $this->isExpired() && !$this->isAuctioned()) {
            $product = Product::findOrFail($this->id);
            $product->end_auction = $product->end_auction->addDays(15);
            $product->save();
            $craftsman = $product->user;
            Mail::raw('We have extended the auction of Your product: << ' . $product->title . ' >> because it has\'t achieved any bids yet!, you can update the product description to be more attractive or you can even delete the product.', function ($mail) use ($craftsman) {
                $mail->from('laraveldemo2018@gmail.com', 'Handicrafts Auction');
                $mail->to($craftsman->email)
                    ->subject('Your Product Auction Has Been Extended Automatically');
            });
            return redirect()->back();//->with('success', ' Acution on: << ' . $this->title . ' >> has been extended automaticlly due to No Bids');
        } else if ($this->not_ordered() && $this->isAuctioned() && $this->isExpired()) {
            $product = Product::findOrFail($this->id);
            $order = Order::create([
                'price' => $this->maxBidPrice(),
                'is-ordered-by-auction' => 1,
                'user_id' => $this->maxBidder()->id,
                'product_id' => $product->id,
                'created_at' => Carbon::now()
            ]);

            if ($order->save()) {
                $this->is_delete = 1;
                $this->update();
                $user = Order::where('product_id', '=', $this->id)->first()->user;
                $product = Order::where('product_id', '=', $this->id)->first()->product;
                Mail::raw('Congrats 🎉, You had won new auction, its for product: << ' . $product->title . ' >>, the product will deliver within 3 hours, please confirm the receipt from Your Orders Panel immediately as you receive your product.', function ($mail) use ($user) {
                    $mail->from('laraveldemo2018@gmail.com', 'Handicrafts Auction');
                    $mail->to($user->email)
                        ->subject('You had won new auction 🎉');
                });
                $craftsman = Product::where('id', '=', $this->id)->first()->user;
                Mail::raw('Congrats 🎉, Your product: << ' . $product->title . ' >> has been ordered by the bidder auction winner:' . $user->username . ', You have 3 hours to deliver it to him, Please check Your Ordered Products Panel to get the buyer address, when you deliver buyer the product ask him to confirm the product delivery from the website immediately as he received it.', function ($mail) use ($craftsman) {
                    $mail->from('laraveldemo2018@gmail.com', 'Handicrafts Auction');
                    $mail->to($craftsman->email)
                        ->subject('Your Have New Ordered Product');
                });

                if (auth()->user() && $this->maxBidder()->id == auth()->user()->id) {
                    return redirect()->back()->with('success', 'Congrats 🎉, You win the acution on: << ' . $product->title . ' >> the product will deliver within 3 hours, please check Your Orders Panel.');
                } else if (auth()->user() && $this->user_id == auth()->user()->id) {
                    return redirect()->back()->with('success', 'Congrats 🎉, ' . $this->maxBidder()->username . ' wins the acution on Your product: << ' . $this->title . ' >>, Check your Ordered Products panel, you have to deliver him the product within 3 hours');
                } else {
                    return redirect()->back()->with('success', $this->maxBidder()->username . ' wins the acution on: << ' . $this->title . ' >> ');
                }
            }
        }
    }

    public function authenticatedUserWin()
    {
        if ($this->order_by_auction() && ($this->maxBidder()->id == auth()->user()->id))
            return true;
        else return false;
    }
}

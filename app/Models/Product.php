<?php

namespace App\Models;

use App\Models\User;
use App\Models\Bid;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'description',
        'category_id',
        'orderNowPrice',
        'is_delete',
        'remainingTime'
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

    public function bidIncreament() // typing error increment
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
            Mail::raw(trans("We have extended the auction of Your product: << ") . $product->title . trans(" >> because it hasnt achieved any bids yet!, you can update the product description to be more attractive or you can even delete the product."), function ($mail) use ($craftsman) {
                $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                $mail->to($craftsman->email)
                    ->subject(trans('Your Product Auction Has Been Extended Automatically'));
            });
            return redirect()->back();//->with('success', ' Acution on: << ' . $this->title . ' >> has been extended automaticlly due to No Bids');
        } else 
        
        if ($this->not_ordered() && $this->isAuctioned() && $this->isExpired()) {
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
                $otherBidders = User::where('id', '!=', $this->maxBidder()->id);
                $admins = User::where('role_id', '=', 1)->get();
                $ordersURL= route('orders.index');
                foreach($admins as $user) {
                    Mail::raw(trans("There was a new order <<").$product->title.trans(">>, ")."\n \n".trans("Please check the system orders: ")."\n".$ordersURL, function ($mail) use ($user) {
                        $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                        $mail->to($user->email)
                            ->subject(trans('There was a new order'));
                    });
                }
                foreach($otherBidders as $otherBidder){
                    Mail::raw($otherBidder->username.trans(" had won the auction on: << ") . $product->title . trans(" >>."), function ($mail) use ($otherBidder) {
                        $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                        $mail->to($otherBidder->email)
                            ->subject(trans('Auction has finished'));
                    });
                }
                Mail::raw(trans("Congrats 🎉, You had won new auction, its for product: << ") . $product->title . trans(" >>, The product will deliver within 3 hours,")." \n \n" . trans("Please confirm the receipt from Your Orders Panel immediately as you receive your product:")."\n".route('buyer.ordered_products'), function ($mail) use ($user) {
                    $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                    $mail->to($user->email)
                        ->subject(trans('You had won new auction 🎉'));
                });
                $craftsman = Product::where('id', '=', $this->id)->first()->user;
                Mail::raw(trans("Congrats 🎉, Your product: << ") . $product->title . trans(" >> has been ordered by the bidder auction winner:") . $user->username . trans(", You have 3 hours to deliver it to him,")." \n \n". trans(" Please check Your Ordered Products Panel to get the buyer address:")."\n".route('craftsman.ordered_products'). "\n". trans(" When you deliver buyer the product ask him to confirm the product delivery from the website immediately as he received it."), function ($mail) use ($craftsman) {
                    $mail->from('laraveldemo2018@gmail.com', trans('Handicrafts Auction'));
                    $mail->to($craftsman->email)
                        ->subject(trans('Your Have New Ordered Product'));
                });

                if (auth()->user() && $this->maxBidder()->id == auth()->user()->id) {
                    return redirect()->back()->with('success', trans('Congrats 🎉, You win the auction on: << ') . $product->title . trans(' >> the product will deliver within 3 hours, please check Your Orders Panel.'));
                } else if (auth()->user() && $this->user_id == auth()->user()->id) {
                    return redirect()->back()->with('success', trans('Congrats 🎉, ') . $this->maxBidder()->username . trans(' wins the acution on Your product: << ') . $this->title . trans(' >>, Check your Ordered Products panel, you have to deliver him the product within 3 hours'));
                } else {
                    return redirect()->back()->with('success', $this->maxBidder()->username . trans(' wins the acution on: << ') . $this->title . trans(' >> '));
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

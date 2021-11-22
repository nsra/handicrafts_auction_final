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

class Product extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'category_id',
        'orderNowPrice',
        'is_delete'
    ];

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

    public function startingBidPrice()
    {
        return $this->orderNowPrice*(40/100);
    }

    public function bidIncreament()
    {
        return $this->orderNowPrice*(6/100);
    }

    public function maxBidPrice()
    {
        return $this->bids->max('price');
    }

    public function isAuctioned()
    {
       return $this->bids->count() > 0  ?  true : false ;
    } 

    public function isOrdered()
    {
       $orders= Order::where('product_id', $this->id)->count();
       return $orders === 1 ? true : false;
    }
}

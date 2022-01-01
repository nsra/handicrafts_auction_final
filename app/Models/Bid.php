<?php

namespace App\Models;

use App\Models\User;
use App\Models\Product;
use App\Models\Bidupdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'price',
        'product_id',
        'description',
    ];

    protected $dates = ['created_at', 'updated_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function bidupdates()
    {
        return $this->hasMany(Bidupdate::class);
    }

    public function isRelatedToSoftDeletedProduct()
    {
        return $this->product->is_delete == 1 ? true : false;
    }
}

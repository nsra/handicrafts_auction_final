<?php

namespace App\Models;

use App\Models\Bid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidupdate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'price',
        'description',
        'bid_id'
    ];

    protected $dates = [ 'created_at', 'updated_at'];

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }
}

<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'product_id',
        'path'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlists extends Model
{
    use HasFactory;
    protected $table='wishlist';
    
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

}

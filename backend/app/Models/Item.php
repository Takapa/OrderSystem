<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; 
use App\Models\Supplier;
use App\Models\Unit;


class Item extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}

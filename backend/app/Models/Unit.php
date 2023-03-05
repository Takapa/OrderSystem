<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public $guarded = []; 
    
    public function item()
    {
        return $this->hasMany(Item::class);
    }

    
}

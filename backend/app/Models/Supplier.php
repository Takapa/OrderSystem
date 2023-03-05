<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $guarded = []; 
    
    public function item()
    {
        return $this->hasMany(Item::class);
    }

    public function getLists()
    {
        $suppliers = Supplier::pluck('name', 'id');

        return $suppliers;
    }
}

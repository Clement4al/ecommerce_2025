<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    public function scopeSearch($query, $searchText)
    {
        return $query->where('name', 'LIKE', "%$searchText%")
                     ->orWhere('email', 'LIKE', "%$searchText%")
                     ->orWhere('phone', 'LIKE', "%$searchText%")
                     ->orWhere('product_title', 'LIKE', "%$searchText%");


    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['name','slug','description','price','category','stock'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}


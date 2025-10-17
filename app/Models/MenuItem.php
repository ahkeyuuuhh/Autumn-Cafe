<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = ['name','slug','image','description','price','category','stock'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the full URL for the menu item image
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            // If it's a full URL, return as is
            if (filter_var($this->image, FILTER_VALIDATE_URL)) {
                return $this->image;
            }
            // Otherwise, return the storage path
            return asset('storage/' . $this->image);
        }
        // Return a default placeholder image
        return asset('images/menu-placeholder.svg');
    }
}


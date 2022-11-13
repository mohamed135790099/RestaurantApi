<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $fillable=[
        'Longitude',
        'Latitude',
        'rate',
        'title',
        'phone',
        'email',
        'description',
        'image',
        'menu_id',
        'booking_id',
        'order_id'
    ];
    use HasFactory;

    public function booking(){
        return $this->hasMany(Booking::class);
    }

    public function menu(){
        return $this->hasOne(Menu::class);
    }
    public function Order(){
        return $this->hasMany(Order::class);
    }


}


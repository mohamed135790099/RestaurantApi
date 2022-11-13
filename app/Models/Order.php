<?php

namespace App\Models;

use Illuminate\Console\View\Components\Confirm;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
         'price',
         'quantity',
         'meal_id',
         'restaurant_id',

    ];
    public function confrimOrder(){
        return $this->hasOne(ConfrimOrder::class,'order_id');
    }
    public function meal(){
        return $this->hasMany(Meal::class,'order_id');
     }

    public function restaurant(){
        return $this->belongsTo(Restaurant::class,'order_id');
    }
    use HasFactory;
   

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
   protected $fillable=[
    'full_name',
    'num_guest',
    'type_booking',
    'restaurant_id',
    'user_id'
   ];

   public function bookingresturant(){
   return $this->belongsTo(Restaurant::class,'booking_id');
   }



   use HasFactory;
}

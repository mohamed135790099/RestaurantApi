<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $fillable=[
        'title',
        'price',
        'description',
        'rate',
        'review',
        'image_url',
        'category_id',
        'order_id'
   

    ];

    
    public function order(){
        return $this->hasMany(Order::class,'meal_id');
     }
     public function category(){
        return $this->hasMany(category::class);
     }


    use HasFactory;

}

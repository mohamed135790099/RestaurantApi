<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=[
     'restaurant_id',
    ];
    
    
    public function restaurant(){
        return $this->belongsTo(Restaurant::class,'meal_id');
    }

    public function category(){
        return $this->hasMany(Category::class,'menu_id');
     }
    use HasFactory;

}


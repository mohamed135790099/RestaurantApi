<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable=[
        'title',
        'menu_id',
        'image_url'
    ];

    

    public function meal(){
        return $this->hasMany(Meal::class,'category_id');
     }

     

    
    use HasFactory;

}

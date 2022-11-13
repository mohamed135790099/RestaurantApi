<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfrimOrder extends Model
{
    protected $fillable=[
        'user_name',
        'phone',
        'location',
        'order_id',
        'user_id'
    ];

    
    use HasFactory;
}

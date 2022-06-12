<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'order_id',
        'provider',
        'amount',
        'status',
    ];

    public function order(){
        return $this->hasOne(Order::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public $incrementing = false;
}

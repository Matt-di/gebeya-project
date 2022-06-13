<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }
    public $incrementing = false;
}

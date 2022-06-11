<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'show_nav'
    ];


    public function user(){
        $this->belongsTo(User::class);
    }
    public $incrementing = false;

}

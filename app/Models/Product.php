<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'category_id',
        'quantity',
        'price',
        'image'
    ];

    public function productAdded(User $user){
        return $this->carts->contains('user_id',$user->id);
    }
    public function carts(){
        return $this->hasMany(Cart::class);
    }

    public function categories(){
        return  $this->belongsToMany(Category::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public $incrementing = false;
}

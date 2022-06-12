<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Category;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'firstname',
        'lastname',
        'email',
        'password',
        'user_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);      
    }
    public function products(){
        return $this->hasMany(Product::class);      
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
    public $incrementing = false;

}

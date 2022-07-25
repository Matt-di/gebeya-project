<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserShippment extends Model
{
    use HasFactory;
    protected $table = 'user_shippment';

    protected $fillable = [
        'id',
        'user_id',
        'address_line',
        'phone_number',
        'country',
        'state',
        'zip',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

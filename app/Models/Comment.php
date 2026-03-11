<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [

        'order_id',
        'client_id',
        'restaurant_id',
        'comment',

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
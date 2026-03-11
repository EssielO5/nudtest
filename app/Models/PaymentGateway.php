<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        'public_key',
        'private_key',
        'secret_key',
        'mode',
        'restaurant_id',
    ];

    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
}
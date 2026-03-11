<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'adresse',
        'plats',
        'montant_total',
        'method_of_paiement',
        'client_id',
        'restaurant_id',
    ];

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
    public function comment(){
        return $this->belongsTo(Comment::class);
    }
}
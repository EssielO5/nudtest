<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];
    public function sender_client()
    {
        return $this->belongsTo(Client::class, 'sender_id');
    }

    public function receiver_restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'receiver_id');
    }

    public function sender_restaurant()
    {
        return $this->belongsTo(Restaurant::class, 'sender_id');
    }

    public function receiver_client()
    {
        return $this->belongsTo(Client::class, 'receiver_id');
    }

}

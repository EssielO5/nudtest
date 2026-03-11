<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Restaurant extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'restaurant';
    protected $fillable = [
        'name',
        'phone',
        'location',
        'longitude',
        'latitude',
        'description',
        'image',
        'email',
        'password',
        'status',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
    public function payment_gateway(){
        return $this->belongsTo(PaymentGateway::class);
    }
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

    public function scopeAddDistance(
        Builder $query,
        array $coordinates,
    ): void {
        $longitude = $coordinates[0];
        $latitude = $coordinates[1];
    
        $query
            ->when(is_null($query->getQuery()->columns), static fn (Builder $query) => $query->select('*'))
            ->selectRaw('
                ST_Distance(
                    ST_GeomFromText(CONCAT(\'POINT(\', longitude, \' \', latitude, \')\'), 4326),
                    ST_GeomFromText(?, 4326)
                ) AS distance
            ', [sprintf('POINT(%f %f)', $longitude, $latitude)]);
    }
    
}
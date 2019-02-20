<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const STATUS_ON_MODERATION = 1;
    const STATUS_BANNED = 2;
    const STATUS_ACCEPTED = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'is_admin',
        'city_id',
        'mobile_phone',
        'status_id',
        'can_be_brand_face',
        'about_me',
        'avatar',
        'password',
        'created_at',
        'updated_at'
    ];

    public $timestamps = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function code()
    {
        return $this->hasOne(Sms::class, 'user_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function prizes()
    {
        return $this->belongsToMany(Prize::class, 'user_prize', 'user_id', 'prize_id');
    }
}

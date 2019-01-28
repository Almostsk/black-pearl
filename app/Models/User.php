<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
        'is_mobile_verified',
        'is_profile_moderated',
        'can_be_brand_face',
        'about_me',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

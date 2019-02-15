<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'sms';

    protected $fillable = ['user_id', 'message_body', 'created_at', 'updated_at'];

    protected $casts = [
        'user_id' => 'integer'
    ];

    protected function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}

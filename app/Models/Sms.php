<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'sms';

    protected $fillable = ['mobile_phone', 'message_body', 'created_at', 'updated_at'];

}

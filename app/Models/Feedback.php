<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = [
        'active', 'name', 'email', 'mobile_phone', 'message', 'created_at', 'updated_at'
    ];
}

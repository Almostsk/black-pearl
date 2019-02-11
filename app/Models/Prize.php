<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prize extends Model
{
    public const BLACK_PERL = 1;
    public const ADD_FACE = 2;

    protected $table = 'prizes';

    protected $fillable = ['name'];
}

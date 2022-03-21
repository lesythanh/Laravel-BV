<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = [
        'email',
        'phone',
        'name',
        'user_id',
        'price'
      ];
}

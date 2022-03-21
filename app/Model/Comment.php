<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = [
        'comment',
        'blog_id',
        'user_id',
        'user_name',
        'user_avatar',
        'level'
    ];
}

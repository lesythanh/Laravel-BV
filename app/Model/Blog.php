<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = [
        'title',
        'image',
        'description',
        'content'
    ];

    public function comment() {
        return $this->hasMany('App\Model\Comment', 'blog_id');
    }
}

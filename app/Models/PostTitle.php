<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTitle extends Model
{
    protected $fillable = ['title', 'parent_id'];
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }
    public function parent()
    {
        return $this->hasOne('App\Models\PostTitle', 'id','parent_id');
    }
}

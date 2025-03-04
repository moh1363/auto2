<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{

    protected $fillable = [
        'user_id',
        'skill_id',
        'level',
        'approved_time',
        'created_by',
        'status',
        'approved_by',
        'files',
        'description',
    ];
}

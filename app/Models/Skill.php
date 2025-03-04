<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Skill extends Model
{
    protected $fillable = ['title', 'description'];
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('level', 'approved_time', 'created_by', 'status', 'approved_by', 'files', 'description');
    }
}

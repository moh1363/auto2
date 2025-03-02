<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Morakhasi extends Model
{
    protected $fillable = ['days_number', 'start_date', 'end_date', 'user_id', 'personnel_id', 'type', 'comments','files','status'];

    public function users()
    {
        return $this->belongsToMany(users::class,'morakhasi_user');
    }
}

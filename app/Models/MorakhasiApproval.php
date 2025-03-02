<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MorakhasiApproval extends Model
{
    protected $fillable =['morakhasi_id','approver_id','is_checked','view_time','approved_time'];
    public function morakhasi(){
        return $this->belongsTo(Morakhasi::class);
    }
    public function approver(){
        return $this->belongsTo(User::class,'approver_id');
    }
}

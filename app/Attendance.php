<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable =['log_type','created_by',];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $fillable=['leave_type','leave_cause','leave_start','leave_end','created_by'];
    
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

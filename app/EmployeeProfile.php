<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    protected $fillable =['name','date_joining','position','department','location',
    'date_termination','created_by',];

     public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

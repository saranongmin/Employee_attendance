<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Credential extends Model
{
    protected $fillable =['cv','academic_records','nid_passport','bank_details','created_by',];
    
    public function createdBy()
    {
        return $this->belongsTo(EmployeeProfile::class, 'created_by');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddEmployee extends Model
{
    protected $fillable = [
        'name','email','created_by', ];
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
         'name_org','logo','address','contact_person','another_user','email','phone','website',
    ];

    public function employeeProfiles()
    {
        return $this->hasMany(EmployeeProfile::class);

    }
}

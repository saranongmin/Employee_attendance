<?php

namespace App\Policies;

use App\User;
use App\EmployeeProfile;
use App\Attendance;
use Illuminate\Auth\Access\HandlesAuthorization;

class AttendancePolicy
{
    use HandlesAuthorization;
   public function viewAny(User $user)
    {
       return $user->isEmployee()|| $user->isAdmin();

    }
   
    public function create(User $user)
    {
        return $user->isAdmin()||$user->isEmployee();


    }
    public function view(User $user, Attendance $attendance)
    {
        return $user->isAdmin();
     }

public function update(User $user,Attendance $attendance)
{

return $user->isAdmin();

}

     public function delete(User $user, Attendance $attendance)
     {
        return $user->isAdmin();
     }
    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}

<?php

namespace App\Policies;

use App\User;
use App\EmployeeProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;
  public function viewAny(User $user)
    {
     return $user->isAdmin();

    }

    public function create(User $user)
    {
        return $user->isEmployee()||$user->isAdmin();
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

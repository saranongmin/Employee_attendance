<?php

namespace App\Policies;

use App\User;
use App\EmployeeProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;


  public function viewAny(User $user)
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

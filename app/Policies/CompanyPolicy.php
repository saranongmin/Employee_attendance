<?php

namespace App\Policies;

use App\User;
use App\CompanyProfile;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
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

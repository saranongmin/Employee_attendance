<?php

namespace App\Policies;

use App\User;
use App\Credential;
use Illuminate\Auth\Access\HandlesAuthorization;

class CredentialPolicy
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
